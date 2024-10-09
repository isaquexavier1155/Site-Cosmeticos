<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="icon" href="{{ asset('images/others/icon.png') }}">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Limita a largura */
            width: 90%; /* Responsivo */
        }
        .success-icon {
            font-size: 50px;
            color: #28a745;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 18px;
            color: #666;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .link {
            display: inline-block;
            margin-top: 10px;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
            transition: text-decoration 0.3s;
        }
        .link:hover {
            text-decoration: underline;
        }
    </style>
    <title>Pagamento Aprovado</title>
</head>
<body>
    <div class="container">
        <i class="fas fa-check-circle success-icon"></i>
        <h1>Pagamento Aprovado!</h1>
        <p>Seu pagamento foi realizado com sucesso. Obrigado pela sua compra!</p>
        <a href="/" class="btn">Voltar à Página Inicial</a>
        <br>
        <a href="https://cintrabeauty.com.br/my_account" class="link">Minhas Compras</a>
    </div>
</body>
</html>
