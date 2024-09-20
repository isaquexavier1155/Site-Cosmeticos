<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class PainelAdministrativoController extends Controller
{

    public function index()
    {
        // Buscar pagamentos por status
        $preparar = Payment::where('status', 'A preparar')->get();
        $emTransito = Payment::where('status', 'Em trânsito')->get();
        $entregue = Payment::where('status', 'Entregue')->get();

        // Função auxiliar para montar as vendas
        function montarVendas($payments)
        {
            $sales = [];
            foreach ($payments as $payment) {
                // Buscar o usuário associado ao pagamento
                $user = User::find($payment->user_id);

                // Decodificar os campos JSON para produtos e quantidades
                $produto_ids = json_decode($payment->id_produtos);
                $produto_qtds = json_decode($payment->quantidade_produtos);

                $products = [];
                foreach ($produto_ids as $index => $id) {
                    $product = Produto::find($id);

                    if ($product) {
                        // Adicionar a quantidade do produto
                        $product->quantidade = $produto_qtds[$index];
                        $products[] = $product;
                    }
                }

                // Adicionar as informações da venda ao array de vendas
                $sales[] = [
                    'id' => $payment->id, // ID da venda/pagamento
                    'user' => $user, // Usuário que fez a compra
                    'valor_total' => $payment->valor, // Valor total da venda
                    'products' => $products, // Produtos associados à venda
                    'status' => $payment->status,
                    'created_at' => $payment->created_at,
                    'freteselecionado' => $payment->frete_selecionado,
                    'etiqueta_url' => $payment->etiqueta_url, // URL da etiqueta
                ];
            }
            return $sales;
        }

        // Montar as vendas para cada status
        $salesAPreparar = montarVendas($preparar);
        $salesEmTransito = montarVendas($emTransito);
        $salesEntregue = montarVendas($entregue);

        // Retornar as vendas organizadas por status
        return view('painel-administrativo', compact('salesAPreparar', 'salesEmTransito', 'salesEntregue'));
    }



    public function gerarEtiquetaCompleta($saleId)
    {
        // Adiciona ao carrinho
        $adicionarResponse = $this->adicionarAoCarrinho($saleId);

        if ($adicionarResponse->getStatusCode() !== 200) {
            return redirect()->route('painel-administrativo')->with('error', 'Erro ao adicionar ao carrinho.');
        }

        $adicionarData = json_decode($adicionarResponse->getContent(), true);
        $etiquetaId = $adicionarData['response']['id'] ?? null;

        if (!$etiquetaId) {
            return redirect()->route('painel-administrativo')->with('error', 'ID da etiqueta não encontrado.');
        }

        // Compra a etiqueta
        $comprarResponse = $this->comprarEtiqueta($etiquetaId);
        $comprarData = json_decode($comprarResponse->getContent(), true);

        if ($comprarData['status'] !== 'success') {
            return redirect()->route('painel-administrativo')->with('error', 'Erro ao comprar etiqueta: ' . $comprarData['message']);
        }

        // Gere a etiqueta
        $gerarResponse = $this->gerarEtiqueta($saleId, $etiquetaId);

        // Verifica se a geração foi bem-sucedida
        if ($gerarResponse->getStatusCode() === 200) {
            $data = $gerarResponse->getData();
            return redirect()->route('painel-administrativo')->with('success', 'Etiqueta gerada com sucesso! <a href="' . $data->url . '" target="_blank">Imprimir Etiqueta</a>')->with('sale_id', $saleId);
        } else {
            $data = $gerarResponse->getData();
            return redirect()->route('painel-administrativo')->with('error', $data->message ?? 'Erro ao gerar etiqueta.')->with('sale_id', $saleId);
        }

    }



    //Adicionando frete ao carrinho com sucesso
    public function adicionarAoCarrinho($saleId)
    {
        // Buscar o pagamento pelo ID da venda
        $payment = Payment::find($saleId);
        //dd($payment->valor);

        // Se o pagamento não for encontrado, retornar um erro
        if (!$payment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pagamento não encontrado.'
            ]);
        }

        // Buscar o usuário pelo user_id
        $user = User::find($payment->user_id);

        // Se o usuário não for encontrado, retornar um erro
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuário não encontrado.'
            ]);
        }

        // Mapeamento entre o valor da string e o código do serviço
        //passa abaixo no corpo da requisição
        $serviceMap = [
            'PAC' => 1,
            'SEDEX' => 2,
            '.Package' => 3,
            // Adicione mais opções conforme necessário
        ];

        // Verifica se o frete selecionado está no mapeamento e atribui o código correspondente
        $freteSelecionado = $payment->frete_selecionado;
        $service = isset($serviceMap[$freteSelecionado]) ? $serviceMap[$freteSelecionado] : null;


        //dd($service);/////////////////////////
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sandbox.melhorenvio.com.br/api/v2/me/cart');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desativa a verificação de SSL

        // Headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: Bearer ' . env('MELHOR_ENVIO_TOKEN'),
            'Content-Type: application/json',
            'User-Agent: MinhaAplicacao (email@example.com)',
        ]);

        // Corpo da requisição
        $payload = json_encode([
            'service' => $service,
            'from' => [
                'name' => 'Alan Pontes da Silva',
                'phone' => '5511967692383',
                'document' => '44421063800',
                'address' => 'Rua Augusta Vicentim Penatti',
                'complement' => 'Apto 1',
                'number' => '25',
                'district' => 'Vila Azaléia',
                'postal_code' => '18552356',
                'city' => 'Boituva',
                'state_abbr' => 'SP',
                'country_id' => 'BR'
            ],
            'to' => [
                'name' => $user->name, // Supondo que o nome do usuário está no campo 'name'
                'phone' => $user->celular, // Supondo que o telefone está no campo 'phone'
                'document' => $user->cpf, // Supondo que o CPF está no campo 'document'
                'address' => $user->rua, // Endereço do usuário
                'complement' => $user->complemento, // Complemento
                'number' => $user->numero, // Número do endereço
                'district' => $user->bairro, // Bairro
                'postal_code' => $user->cep, // CEP
                'city' => $user->cidade, // Cidade
                'state_abbr' => $user->estado, // Estado
                'country_id' => 'BR' // País
            ],
            'volumes' => [
                [
                    'height' => 7,//altura
                    'width' => 15,//largura
                    'length' => 22,//comprimento
                    'weight' => 0.2//peso médio 200g
                ]

            ],
            'options' => [
                //abaixo defini para seguradora pagar 50% do valor total da copra em caso de extravio
                //isso influencia no valor total do frete
                'insurance_value' => $payment->valor * 0.5,//valor que seguradora pagará em caso de estravio de produto
                'receipt' => false,
                'own_hand' => false,
                'reverse' => false,
                'non_commercial' => true, //false = Indica que o envio é comercial e pode incluir documentos fiscais como nota fiscal ou declaração de conteudo
                'platform' => 'Site Cintra Beauty',
                'tags' => [
                    [
                        'tag' => "Minha conta",
                        'url' => 'https://cintrabeauty.com.br/my_acount'
                    ]
                ]
            ]
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        //dump('Início da função adicionarAoCarrinho'); // Depuração

        $response = curl_exec($ch);

        //dump('Resposta do carrinho: ', $response); // Depuração

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro na requisição cURL: ' . curl_error($ch),
            ]);
        }

        curl_close($ch);

        // Processa a resposta conforme necessário
        return response()->json([
            'status' => 'success',
            'message' => 'Requisição enviada com sucesso',
            'response' => json_decode($response, true)
        ]);
    }

    public function comprarEtiqueta($etiquetaId)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/checkout',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode([
                    "orders" => [$etiquetaId]
                ]),
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Authorization: Bearer ' . env('MELHOR_ENVIO_TOKEN'),
                    'Content-Type: application/json',
                    'User-Agent: Aplicação (email para contato técnico)'
                ),
            ));

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $decodedResponse = json_decode($response, true);

            // Verifica se a compra foi bem-sucedida
            if ($httpCode === 200) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Etiqueta comprada com sucesso!',
                    'response' => $decodedResponse
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Falha ao comprar etiqueta: ' . ($decodedResponse['message'] ?? 'Erro desconhecido.')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro inesperado: ' . $e->getMessage()
            ]);
        }
    }


    //Etiqueta gerada com sucesso
    public function gerarEtiqueta($saleId, $etiquetaId)
    {
        try {
            // Obtém o ID da etiqueta que foi previamente comprada de forma dinâmica
            // Substitua isso pelo valor real obtido de forma dinâmica (por exemplo, do banco de dados)
            //$etiquetaId = $saleId;

            $ch = curl_init();

            // Define a URL da API de sandbox (trocar pela URL de produção depois)
            curl_setopt($ch, CURLOPT_URL, 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/print');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Accept: application/json',
                'Authorization: Bearer ' . env('MELHOR_ENVIO_TOKEN'),
                'Content-Type: application/json',
            ]);

            // Enviando o ID da etiqueta comprada para gerar a etiqueta
            $payload = json_encode([
                'orders' => [$etiquetaId]  // Envia uma array com o(s) ID(s) das etiquetas
            ]);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

            // Desativa a verificação de SSL para desenvolvimento
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Executa a requisição cURL
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if (curl_errno($ch)) {
                curl_close($ch);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Erro na requisição cURL: ' . curl_error($ch),
                ], 500);
            }

            curl_close($ch);

            // Decodifica a resposta JSON
            $decodedResponse = json_decode($response, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Erro ao decodificar resposta JSON: ' . json_last_error_msg(),
                ], 500);
            }

            // Verifica se a etiqueta foi gerada com sucesso
            if ($httpCode === 200 && isset($decodedResponse['url'])) {
                // Atualiza a URL da etiqueta no banco de dados
               //dd($saleId);
                $payment = Payment::find($saleId);  // Ajuste para buscar pelo ID de pagamento se necessário
                if ($payment) {
                    $payment->etiqueta_url = $decodedResponse['url'];
                    $payment->save();
                }

                return response()->json([
                    'status' => 'success',
                    'message' => 'Etiqueta gerada com sucesso',
                    'url' => $decodedResponse['url']
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Falha ao gerar etiqueta',
            ], $httpCode);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro inesperado ao gerar etiqueta: ' . $e->getMessage(),
            ], 500);
        }
    }






}

