<?php
namespace App\Http\Controllers;

use App\Services\MelhorEnvioService;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;


class FreteController extends Controller
{
    protected $melhorEnvio;


    public function retornaDadosEntrega(Request $request)
    {
        // Armazena o valor total na sessão
        $total_geral = $request->input('amount');
        session(['total_geral' => $total_geral]);

        // Recebe os IDs dos produtos e as quantidades no formato de string, por exemplo: "5,8"
        $produto_ids_str = $request->input('produto_ids');
        $produto_qtds_str = $request->input('produto_qtds');
        $frete_selecionado = $request->frete_option;

        // Converte as strings para arrays usando explode
        //$produto_ids = explode(',', $produto_ids_str);
        //$produto_qtds = explode(',', $produto_qtds_str);

        // Depurando para ver os arrays de IDs e quantidades
        //dd($request->frete_option);//"SEDEX"

        // Exibe a view com o formulário de dados de entrega e passa os arrays para a view, se necessário
        return view('checkout-entrega', compact('produto_ids_str', 'produto_qtds_str', 'frete_selecionado'));
    }


    public function salvarDadosEntrega(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'cpf' => 'required|string|max:14',
            'celular' => 'required|string|max:15',
            'cep' => 'required|string|max:9',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'amount' => 'required|numeric',
        ]);

        //Estão chegando como string
        //"8,5" // app\Http\Controllers\FreteController.php:58
        //"1,2" // app\Http\Controllers\FreteController.php:58
        $produto_ids_str = $request->input('produto_ids');
        $produto_qtds_str = $request->input('produto_qtds');
        //dd($request->frete_selecionado);//"SEDEX"
        $frete_selecionado = $request->frete_selecionado;

        //dd($produto_ids_str, $produto_qtds_str);

        // Atualiza os dados do usuário logado
        $user = Auth::user();

        // Preenche os dados
        $user->fill([
            'name' => $validated['nome'],
            'email' => $validated['email'],
            'cpf' => $validated['cpf'],
            'celular' => $validated['celular'],
            'cep' => $validated['cep'],
            'rua' => $validated['rua'],
            'numero' => $validated['numero'],
            'complemento' => $validated['complemento'],
            'bairro' => $validated['bairro'],
            'cidade' => $validated['cidade'],
            'estado' => $validated['estado'],
        ]);

        // Salva as alterações
        if ($user->save()) {
            // Passa as variáveis para a view
            return view('redirect-to-payment', [
                'amount' => $validated['amount'],
                'produto_ids_str' => $produto_ids_str,
                'produto_qtds_str' => $produto_qtds_str,
                'frete_selecionado' => $frete_selecionado
            ]);
        }

        return back()->with('error', 'Não foi possível atualizar os dados do usuário.');
    }


    public function __construct(MelhorEnvioService $melhorEnvio)
    {
        $this->melhorEnvio = $melhorEnvio;
    }


    public function calcularFrete(Request $request)
    {
        // Pegar o token da API do arquivo .env
        $accesstoken = env('MELHOR_ENVIO_TOKEN');
        //dd($request);

        if (!$accesstoken) {
            return response()->json(['error' => 'Token de acesso não encontrado'], 500);
        }


        // Dados necessários para a requisição
        $fromCep = '18552356'; // Substitua pelo CEP de origem real
        $toCep = $request->input('cep');

        if (!$toCep) {
            return response()->json(['error' => 'CEP de destino não fornecido'], 400);
        }

        $products = [
            [
                'name' => 'Produto Exemplo',
                'quantity' => 1,
                'weight' => 0.2,//peso médio 200g
                'length' => 22,//comprimento
                'height' => 7,//altura
                'width' => 15,//largura
            ]
        ];
        $services = '1,2,3'; // Serviços de frete (exemplo: Correios, transportadoras)
        $insuranceValue = 100;

        $curl = curl_init();

        // Configurando a requisição cURL
        curl_setopt_array($curl, [
            //em produção deixar a linha abaixo
            CURLOPT_URL => 'https://melhorenvio.com.br/api/v2/me/shipment/calculate',
            //Em desenvolvimento deixar a linha abaixo
            //CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/calculate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'from' => [
                    'postal_code' => $fromCep
                ],
                'to' => [
                    'postal_code' => $toCep
                ],
                'products' => $products,
                'services' => $services,
                'insurance_value' => $insuranceValue,
                'options' => [
                    'receipt' => false,
                    'own_hand' => false,
                    'reverse' => false,
                    'non_commercial' => true
                ]
            ]),
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: Bearer ' . $accesstoken,
                'Content-Type: application/json',
                'User-Agent: Aplicação (email para contato técnico)'
            ],

            //CURLOPT_SSL_VERIFYPEER => false,  // Deixar essa linha em desenvolvimento
             CURLOPT_CAINFO => base_path('certificates/cacert.pem'), //deixar essa linha em produção
        ]);

        // Executando a requisição e capturando a resposta
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error = curl_error($curl);
            curl_close($curl);
            return response()->json(['error' => 'Erro ao realizar a requisição: ' . $error], 500);
        }

        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // Verifique se o código de status é válido
        if ($statusCode == 200) {
            return response()->json(json_decode($response), 200);
        } else {
            return response()->json(['error' => 'Erro na resposta da API: ' . $response], $statusCode);
        }
    }







}
