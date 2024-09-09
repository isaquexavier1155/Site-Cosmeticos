<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; // Importa a classe Payment
class PagamentoController extends Controller
{

    public function viewPagamento(){
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
            $amount = $request->input('amount');
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

    public function processarPagamento(Request $request)
    {
        $accessToken = env('MERCADOPAGO_ACCESS_TOKEN');
        $preferenceUrl = 'https://api.mercadopago.com/checkout/preferences?access_token=' . $accessToken;

        $data = [
            'items' => [
                [
                    'title' => 'Produto Exemplo',
                    'quantity' => 1,
                    'unit_price' => 100.00
                ]
            ],
            'back_urls' => [
                'success' => route('pagamento.sucesso'),
                'failure' => route('pagamento.falha'),
                'pending' => route('pagamento.pendente')
            ],
            'auto_return' => 'approved'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $preferenceUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            return response()->json(['error' => $error], 500);
        }

        curl_close($ch);

        $responseData = json_decode($response, true);

        return response()->json(['preference_id' => $responseData['id']]);
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
        }}

    public function sucesso()
    {
        return view('pagamento.sucesso');
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