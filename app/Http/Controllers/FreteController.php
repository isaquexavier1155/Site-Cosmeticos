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

        // Exibe a view com o formulário de dados de entrega
        return view('checkout-entrega');
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
            return view('redirect-to-payment', ['amount' => $validated['amount']]);
        }

        return back()->with('error', 'Não foi possível atualizar os dados do usuário.');
    }


    public function __construct(MelhorEnvioService $melhorEnvio)
    {
        $this->melhorEnvio = $melhorEnvio;
    }

    public function calcularFrete(Request $request)
    {
        // Dados de envio, baseados no que você vai coletar do frontend
        $dadosEnvio = [
            "from" => [
                "postal_code" => "01010000", // CEP de origem
            ],
            "to" => [
                "postal_code" => $request->cep_destino, // CEP de destino
            ],
            "products" => [
                [
                    "weight" => 0.5, // Peso do produto
                    "width" => 16,
                    "height" => 12,
                    "length" => 18,
                    "quantity" => 1,
                ],
            ],
            "services" => "1,2", // Tipos de serviço (Correios, JadLog, etc.)
            "insurance_value" => 100.00, // Valor do seguro do envio
            "options" => [
                "receipt" => false, // Aviso de recebimento
                "own_hand" => false, // Mão própria
            ],
        ];

        // Chama o serviço para calcular o frete
        $frete = $this->melhorEnvio->calcularFrete($dadosEnvio);

        // Retorna a resposta como JSON
        return response()->json($frete);
    }


}
