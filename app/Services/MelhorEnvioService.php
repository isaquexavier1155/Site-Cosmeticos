<?php
namespace App\Services;

class MelhorEnvioService
{
    protected $apiKey;
    protected $userAgent;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('MELHOR_ENVIO_API_KEY');
        $this->userAgent = env('MELHOR_ENVIO_USER_AGENT');
        $this->baseUrl = env('MELHOR_ENVIO_BASE_URL');
    }

    public function calcularFrete($dadosEnvio)
    {
        // URL para cálculo de frete
        $url = "{$this->baseUrl}/api/v2/me/shipment/calculate";

        // Inicializa o cURL
        $ch = curl_init();

        // Configurações do cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'User-Agent: ' . $this->userAgent,
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dadosEnvio));

        // Executa a requisição
        $response = curl_exec($ch);

        // Verifica por erros
        if (curl_errno($ch)) {
            return ['error' => curl_error($ch)];
        }

        // Fecha a conexão cURL
        curl_close($ch);

        // Retorna a resposta como array
        return json_decode($response, true);
    }
}
