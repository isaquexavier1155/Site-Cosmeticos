<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
</head>
<body>
    <h1>{{ $produto->nome }}</h1>
    <p>{{ $produto->descricao }}</p>
    <p>Preço: {{ $produto->preco }}</p>
    <p>Preço Promocional: {{ $produto->preco_promocional }}</p>
    <p>Quantidade em Estoque: {{ $produto->quantidade_estoque }}</p>
    <p>Categoria: {{ $produto->categoria }}</p>
    <p>Tags: {{ $produto->tags }}</p>
    <p>Status: {{ $produto->ativo ? 'Ativo' : 'Inativo' }}</p>
    
    @if($produto->imagem)
        <img src="{{ asset('images/products/' . $produto->imagem) }}" alt="{{ $produto->nome }}" />
    @endif

    @if($produto->imagens_adicionais)
        <h3>Imagens Adicionais:</h3>
        @foreach(json_decode($produto->imagens_adicionais) as $imagem)
            <img src="{{ asset('images/products/' . $imagem) }}" alt="Imagem adicional" />
        @endforeach
    @endif

   
</body>
</html>
