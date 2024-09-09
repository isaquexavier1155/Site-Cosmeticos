<!-- resources/views/sucesso.blade.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Concluído</title>
</head>
<body>
    <h1>Pagamento Concluído com Sucesso!</h1>
    
    @if($payment_id)
        <p>ID do Pagamento: {{ $payment_id }}</p>
    @else
        <p>Não foi possível recuperar o ID do pagamento.</p>
    @endif

    <!-- Você pode adicionar mais informações ou um link para retornar ao site -->
    <a href="{{ url('/') }}">Voltar para a página inicial</a>
</body>
</html>
