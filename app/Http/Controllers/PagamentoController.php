<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Payment; // Importa a classe Payment
use Illuminate\Support\Facades\Auth;


class PagamentoController extends Controller
{

    public function viewPagamento()
    {
        $accesstoken = env('MERCADOPAGO_ACCESS_TOKEN');

        $amount = 100;

        if (empty($amount) || !is_numeric($amount)) {
            return response()->json(['error' => 'Valor deve ser um número válido.'], 400);
        }

        if ($amount < 1 || $amount > 100) {
            return response()->json(['error' => 'Valor deve estar entre 1 e 100.'], 400);
        }

        $amount = (float) $amount;

        // Utiliza o modelo Payment para adicionar um pagamento
        $payCreate = Payment::addPayment($amount, 1);

        if (!$payCreate) {
            return response()->json(['error' => 'Erro ao criar pagamento.'], 500);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "back_urls" => array(
                    "success" => "https://google.com/success",
                    "pending" => "https://google.com/pending",
                    "failure" => "https://google.com/failure"
                ),
                "external_reference" => $payCreate,
                "notification_url" => "https://google.com",
                "auto_return" => "approved",
                "items" => array(
                    array(
                        "title" => "Dummy Title",
                        "description" => "Dummy description",
                        "picture_url" => "http://www.myapp.com/myimage.jpg",
                        "category_id" => "car_electronics",
                        "quantity" => 1,
                        "currency_id" => "BRL",
                        "unit_price" => $amount
                    )
                ),
                "payment_methods" => array(
                    "excluded_payment_methods" => array(
                        array("id" => "pix")
                    ),
                    "excluded_payment_types" => array(
                        array("id" => "ticket")
                    )
                )
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $accesstoken
            ),
            CURLOPT_CAINFO => base_path('certificates/cacert.pem'),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            return response()->json(['error' => 'cURL Error: ' . curl_error($curl)], 500);
        }

        curl_close($curl);

        $obj = json_decode($response);


        if (isset($obj->id)) {
            return view('pagamento', [
                'preference_id' => $obj->id,
                'amount' => $amount
            ]);
        } else {
            return response()->json(['error' => 'Erro ao criar preferência de pagamento.'], 500);
        }

    }
    public function showPagamento(Request $request)
    {
        $accesstoken = env('MERCADOPAGO_ACCESS_TOKEN');

        //esse valor esta sendo passado para a view pagamento.blade.php
        //e quando um pagamento por link 1 (wallet_purchase) é iniciado obtem sempre esse valor
        $amount = $request->amount;
        $user = Auth::user();

       // var_dump($request->status);
        

        if (empty($amount) || !is_numeric($amount)) {
            return response()->json(['error' => 'Valor deve ser um número válido.'], 400);
        }

        if ($amount < 1) {
            return response()->json(['error' => 'Valor deve ser maior que zero.'], 400);
        }

        $amount = (float) $amount;

        // Utiliza o modelo Payment para adicionar um pagamento
        //Ajustei linha abaixo
        $payCreate = Payment::addPayment($amount, $user->id);

        if (!$payCreate) {
            return response()->json(['error' => 'Erro ao criar pagamento.'], 500);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "back_urls" => array(
                    "success" => "https://google.com/success",
                    "pending" => "https://google.com/pending",
                    "failure" => "https://google.com/failure"
                ),
                "external_reference" => $payCreate,
                "notification_url" => "https://google.com",
                "auto_return" => "approved",
                "items" => array(
                    array(
                        "title" => "Dummy Title",
                        "description" => "Dummy description",
                        "picture_url" => "http://www.myapp.com/myimage.jpg",
                        "category_id" => "car_electronics",
                        "quantity" => 1,
                        "currency_id" => "BRL",
                        "unit_price" => $amount
                    )
                ),
                "payment_methods" => array(
                    "excluded_payment_methods" => array(
                        array("id" => "pix")
                    ),
                    "excluded_payment_types" => array(
                        array("id" => "ticket")
                    )
                )
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $accesstoken
            ),
            CURLOPT_CAINFO => base_path('certificates/cacert.pem'),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            return response()->json(['error' => 'cURL Error: ' . curl_error($curl)], 500);
        }

        curl_close($curl);

        $obj = json_decode($response);

        if (isset($obj->id)) {
            $amount = $request->input('amount');
           //inserir retorno para ver se amount não vem no objeto echo($obj);
            return view('pagamento', [
                'preference_id' => $obj->id,
                'amount' => $amount
            ]);
        } else {
            return response()->json(['error' => 'Erro ao criar preferência de pagamento.'], 500);
        }


        // Verifique se o valor é válido
        if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
            return redirect()->back()->withErrors(['error' => 'Valor inválido.']);
        }

        //return view('pagamento', ['amount' => $amount]);
    }

    /* Função acionada ao clicar em Pagar no Formulário do Bricks */
    public function processarPagamento(Request $request)
    {


        $body = json_decode($request->getContent());

        // Verificar se $body foi decodificado corretamente
        if (!$body) {
            return response()->json(['error' => 'Corpo da requisição inválido.'], 400);
        }

        //Verfica se pagamento é via pix e entra na seguinte condição
        if ($body->payment_method_id == 'pix') {
            // access token arquivo config.php
            $accesstoken = env('MERCADOPAGO_ACCESS_TOKEN');

            // Gera uma chave idempotente única para esta requisição
            $idempotencyKey = uniqid('key_', true);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mercadopago.com/v1/payments',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode([
                    "description" => "Payment for product",
                    "external_reference" => "1255455",
                    "notification_url" => "https://www.google.com/",
                    "payer" => [
                        "email" => $body->payer->email,
                        "identification" => [
                            "type" => "CPF",
                            "number" => "03213135003"
                        ]
                    ],
                    "payment_method_id" => $body->payment_method_id,
                    "transaction_amount" => $body->transaction_amount,
                ]),

                     

               /*  $data = [
                    'description' => 'Payment for product',
                    'installments' => $body->installments,
                    'payer' => [
                        'email' => $body->payer->email,
                        'identification' => [
                            'type' => $body->payer->identification->type,
                            'number' => $body->payer->identification->number,
                        ],
                    ],
                    'issuer_id' => $body->issuer_id,
                    'payment_method_id' => $body->payment_method_id,
                    'token' => $body->token,
                    'transaction_amount' => $body->transaction_amount,
                ]; */

                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $accesstoken,
                    'X-Idempotency-Key: ' . $idempotencyKey
                ),
                //CURLOPT_SSL_VERIFYPEER => false,  // Deixar essa linha em desenvolvimento
                CURLOPT_CAINFO => base_path('certificates/cacert.pem'), //deixar essa linha em produção
            ));

            /* if ($body) {
                return response()->json([
                    'error' => 'Corpo da requisição:',
                    'body' => $body
                ], 400);
            } */  

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                echo 'cURL Error: ' . curl_error($curl);
            }

            curl_close($curl);

            $obj = json_decode($response);

            $chavePix = $obj->point_of_interaction->transaction_data->qr_code;
            /* echo "Chave Pix: {$chavePix}"; */

            if ($obj !== null && isset($obj->id)) {
                if ($obj->id != NULL) {
                    echo $response;
                    die;

                }
            } else {
                echo 'Erro ao decodificar a resposta';
            }

        } else {

            $accessToken = env('MERCADOPAGO_ACCESS_TOKEN');
            $idempotencyKey = bin2hex(random_bytes(16)); // Gera uma chave idempotente única

            $paymentUrl = 'https://api.mercadopago.com/v1/payments?access_token=' . $accessToken;

            $data = [
                'description' => 'Payment for product',
                'installments' => $body->installments,
                'payer' => [
                    'email' => $body->payer->email,
                    'identification' => [
                        'type' => $body->payer->identification->type,
                        'number' => $body->payer->identification->number,
                    ],
                ],
                'issuer_id' => $body->issuer_id,
                'payment_method_id' => $body->payment_method_id,
                'token' => $body->token,
                'transaction_amount' => $body->transaction_amount,
            ];

            /*     if ($data) {
                    return response()->json([
                        'error' => '$data válida.',
                        'body' => $data
                    ], 400);
                } */

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $paymentUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30, // Timeout aumentado para 30 segundos
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $accessToken,
                    'X-Idempotency-Key: ' . $idempotencyKey,
                ],
                //CURLOPT_SSL_VERIFYPEER => false,  // Deixar essa linha em desenvolvimento
                CURLOPT_CAINFO => base_path('certificates/cacert.pem'), //deixar essa linha em produção
          
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Obtém o código HTTP da resposta

            if (curl_errno($ch)) {
                $error = curl_error($ch);
                curl_close($ch);
                return response()->json(['error' => $error], 500);
            }

            curl_close($ch);

            // Verifica se a resposta não foi um erro de servidor
            if ($httpCode >= 400) {
                return response()->json(['error' => 'Erro na API do Mercado Pago', 'details' => $response], $httpCode);
            }

            $responseData = json_decode($response, true);

            if (isset($responseData['id'])) {
                echo $response;
                die;
                /*         return response()->json(['payment_id' => $responseData['id']]);
                 */
            } else {
                return response()->json(['error' => 'Payment ID não encontrado na resposta do servidor.'], 500);
            }
        }
    }



    public function getPreference(Request $request)
    {
        $accesstoken = env('MERCADOPAGO_ACCESS_TOKEN');

        $amount = 100;

        if (empty($amount) || !is_numeric($amount)) {
            return response()->json(['error' => 'Valor deve ser um número válido.'], 400);
        }

        if ($amount < 1 || $amount > 100) {
            return response()->json(['error' => 'Valor deve estar entre 1 e 100.'], 400);
        }

        $amount = (float) $amount;

        // Utiliza o modelo Payment para adicionar um pagamento
        $payCreate = Payment::addPayment($amount, 1);

        if (!$payCreate) {
            return response()->json(['error' => 'Erro ao criar pagamento.'], 500);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "back_urls" => array(
                    "success" => "https://google.com/success",
                    "pending" => "https://google.com/pending",
                    "failure" => "https://google.com/failure"
                ),
                "external_reference" => $payCreate,
                "notification_url" => "https://google.com",
                "auto_return" => "approved",
                "items" => array(
                    array(
                        "title" => "Dummy Title",
                        "description" => "Dummy description",
                        "picture_url" => "http://www.myapp.com/myimage.jpg",
                        "category_id" => "car_electronics",
                        "quantity" => 1,
                        "currency_id" => "BRL",
                        "unit_price" => $amount
                    )
                ),
                "payment_methods" => array(
                    "excluded_payment_methods" => array(
                        array("id" => "pix")
                    ),
                    "excluded_payment_types" => array(
                        array("id" => "ticket")
                    )
                )
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $accesstoken
            ),
            CURLOPT_CAINFO => base_path('certificates/cacert.pem'),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            return response()->json(['error' => 'cURL Error: ' . curl_error($curl)], 500);
        }

        curl_close($curl);

        $obj = json_decode($response);

        if (isset($obj->id)) {
            return view('pagamento', [
                'preference_id' => $obj->id,
                'amount' => $amount
            ]);
        } else {
            return response()->json(['error' => 'Erro ao criar preferência de pagamento.'], 500);
        }
    }

    // No seu PaymentController

    public function sucesso(Request $request)
    {
        $paymentId = $request->input('payment_id');
        // Você pode usar o paymentId aqui para registrar o pagamento ou atualizar o status do pedido

        // Exemplo de uso: Você pode passar o paymentId para uma view
        return view('sucesso', ['payment_id' => $paymentId]);
    }


    public function falha()
    {
        return view('pagamento.falha');
    }

    public function pendente()
    {
        return view('pagamento.pendente');
    }
    
}