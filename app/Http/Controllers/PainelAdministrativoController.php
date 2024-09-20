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
    
    //$etiquetaId = '9d0acdf3-b34f-4a22-8465-ab9d686337b8'; // Substitua isso pelo valor dinâmico ou real

    public function gerarEtiqueta($saleId)
    {
        try {
            // Obtém o ID da etiqueta que foi previamente comprada
            //trocar pelo id criado ao adicionar ao carrinho eu acho
            $etiquetaId = '9d0acdf3-b34f-4a22-8465-ab9d686337b8'; // Substitua isso pelo valor dinâmico ou real
    
            $ch = curl_init();
    
            //trocar pela url de produção depois
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
                'orders' => [$etiquetaId]  // Envie uma array com o(s) ID(s) das etiquetas
            ]);
    
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    
            // Desativando a verificação de SSL para desenvolvimento
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
            if (curl_errno($ch)) {
                return redirect()->route('painel-administrativo')->with('error', 'Erro na requisição cURL: ' . curl_error($ch));
            }
    
            curl_close($ch);
    
            // Decodifica a resposta JSON
            $decodedResponse = json_decode($response, true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->route('painel-administrativo')->with('error', 'Erro ao decodificar resposta JSON: ' . json_last_error_msg());
            }
    
            // Verifica se a etiqueta foi gerada com sucesso
            if ($httpCode === 200 && isset($decodedResponse['url'])) {
                // Atualiza a URL da etiqueta no banco de dados para o pagamento correspondente
                $payment = Payment::find($saleId);  // Ajuste para buscar pelo ID de pagamento se necessário
                if ($payment) {
                    $payment->etiqueta_url = $decodedResponse['url'];
                    $payment->save();
                }
    
                return redirect()->route('painel-administrativo')->with('success', 'Etiqueta gerada com sucesso. <a href="' . $decodedResponse['url'] . '" target="_blank">Imprimir Etiqueta</a>');
            }
    
            return redirect()->route('painel-administrativo')->with('error', 'Falha ao gerar etiqueta');
        } catch (\Exception $e) {
            return redirect()->route('painel-administrativo')->with('error', 'Erro inesperado ao gerar etiqueta: ' . $e->getMessage());
        }
    }
    
    
    











    //Atualiza Status da venda na aba minhas vendas-> APreparar
    public function updateStatus(Request $request, $id)
    {
        $sale = Payment::findOrFail($id);
        $sale->status = $request->input('status');
        $sale->save();

        return redirect()->back()->with('success', 'Status da venda atualizado com sucesso.');
    }










}
