<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Tagify CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">

    <!-- Tagify JS -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
    height: 100%;
    margin: 0;
}

body {
    background-color: #1f261d;
    color: black;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 5rem;
    padding-bottom: 11rem;
}

.container {
    background-color: white;
    padding: 6rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
}

.form-label {
    font-weight: bold;
}

.form-control, .form-select {
    border-radius: 0.375rem;
    box-shadow: none;
    border: 1px solid #ced4da;
    width: 100%;
    margin-bottom: 1rem;
    height: 4vh;

}

.form-control:focus, .form-select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
}

.btn-primary {
    background-color: #007bff;
    border: none;
    border-radius: 0.375rem;
    padding: 0.5rem 1rem;
    width: 100%;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.text-danger {
    font-size: 0.875rem;
    color: #dc3545;
}

.alert {
    border-radius: 0.375rem;
}

.mb-3 #caracteristicas{
    background-color: red!important;
}


    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastrar Produto</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" value="" required>
                @error('nome')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="3" required></textarea>
                @error('descricao')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="modo_de_usar" class="form-label">Modo de Usar:</label>
                <textarea name="modo_de_usar" id="modo_de_usar" class="form-control" rows="3">{{ old('modo_de_usar') }}</textarea>
                @error('modo_de_usar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="caracteristicas" class="form-label">Características:</label>
                <textarea placeholder="Digite um item e pressione enter" name="caracteristicas" id="caracteristicas" class="form-control" rows="3">{{ old('caracteristicas') }}</textarea>
                @error('caracteristicas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço Normal:</label>
                <input type="number" name="preco" id="preco" class="form-control" step="0.01"  required>
                @error('preco')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="preco_promocional" class="form-label">Preço Promocional:</label>
                <input type="number" name="preco_promocional" id="preco_promocional" class="form-control" step="0.01" required>
                @error('preco_promocional')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantidade_estoque" class="form-label">Quantidade em Estoque:</label>
                <input type="number" name="quantidade_estoque" id="quantidade_estoque" class="form-control" required>
                @error('quantidade_estoque')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
    <label for="categoria" class="form-label">Categoria:</label>
    <select id="categoria" name="categoria" class="form-select" required>
        <option value="">Selecione a Categoria</option>
        <option value="Perfumes" {{ old('categoria') == 'Perfumes' ? 'selected' : '' }}>Perfumes</option>
        <option value="Body splash" {{ old('categoria') == 'Body splash' ? 'selected' : '' }}>Body splash</option>
        <option value="Hidratantes" {{ old('categoria') == 'Hidratantes' ? 'selected' : '' }}>Hidratantes</option>
    </select>
    @error('categoria')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem Principal</label>
                <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*" required>
                @error('imagem')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="imagens_adicionais" class="form-label">Imagens Adicionais</label>
                <input type="file" name="imagens_adicionais[]" id="imagens_adicionais" class="form-control" accept="image/*" multiple required>
                @error('imagens_adicionais.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>

    
            <!-- Limita Imagens adicionais em 3
 -->
 <script>
                function validateFileCount(input) {
                    if (input.files.length > 3) {
                        alert('Você só pode enviar no máximo 3 imagens adicionais.');
                        input.value = ''; // Limpa o campo de input
                    }
                }
            </script>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Inicializa o Tagify no campo 'caracteristicas'
                    new Tagify(document.querySelector("#caracteristicas"), {
                        delimiters: ", ",  // Opções para delimitadores
                        maxTags: 10,       // Limite de tags
                        dropdown: {
                            enabled: 0     // Desabilita o dropdown de sugestões
                        }
                    });
                });
            </script>

 
    <script src="{{ asset('js/app.js') }}"></script>







</body>

</html>


