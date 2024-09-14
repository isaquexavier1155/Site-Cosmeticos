<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecionando para Pagamento</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('payment-form').submit();
        });
    </script>
</head>
<body>
    <form id="payment-form" action="{{ route('payment') }}" method="POST">
        @csrf
        <input type="hidden" name="amount" value="{{ $amount }}">
        <button type="submit">Redirecionando para ambiente seguro...</button>
    </form>
</body>
</html>
