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
        <input type="hidden" name="produto_ids" value="{{ $produto_ids_str }}">
        <input type="hidden" name="produto_qtds" value="{{ $produto_qtds_str }}">
        <input type="hidden" name="frete_selecionado" value="{{ $frete_selecionado }}">

        

        <!-- <button type="submit"></button> -->
    </form>
</body>
</html>
