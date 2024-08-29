<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', 'creme') }}" required>
                @error('nome')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="3" required>{{ old('descricao', 'creme hidratante') }}</textarea>
                @error('descricao')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" name="preco" id="preco" class="form-control" step="0.01" value="{{ old('preco', '120') }}" required>
                @error('preco')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="preco_promocional" class="form-label">Preço Promocional</label>
                <input type="number" name="preco_promocional" id="preco_promocional" class="form-control" step="0.01" value="{{ old('preco_promocional', '85') }}">
                @error('preco_promocional')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantidade_estoque" class="form-label">Quantidade em Estoque</label>
                <input type="number" name="quantidade_estoque" id="quantidade_estoque" class="form-control" value="{{ old('quantidade_estoque', '10') }}" required>
                @error('quantidade_estoque')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select id="categoria" name="categoria" class="form-control">
                    <option value="Cuidados com a pele" {{ old('categoria') == 'Cuidados com a pele' ? 'selected' : '' }}>Cuidados com a pele</option>
                    <option value="Hidratantes" {{ old('categoria') == 'Hidratantes' ? 'selected' : '' }}>Hidratantes</option>
                    <option value="Protetores solares" {{ old('categoria') == 'Protetores solares' ? 'selected' : '' }}>Protetores solares</option>
                    <option value="Limpeza facial (sabonetes, géis de limpeza)" {{ old('categoria') == 'Limpeza facial (sabonetes, géis de limpeza)' ? 'selected' : '' }}>Limpeza facial (sabonetes, géis de limpeza)</option>
                    <option value="Esfoliantes" {{ old('categoria') == 'Esfoliantes' ? 'selected' : '' }}>Esfoliantes</option>
                    <option value="Tônicos" {{ old('categoria') == 'Tônicos' ? 'selected' : '' }}>Tônicos</option>
                    <option value="Maquiagem" {{ old('categoria') == 'Maquiagem' ? 'selected' : '' }}>Maquiagem</option>
                    <option value="Corretivos" {{ old('categoria') == 'Corretivos' ? 'selected' : '' }}>Corretivos</option>
                    <option value="Pó facial" {{ old('categoria') == 'Pó facial' ? 'selected' : '' }}>Pó facial</option>
                    <option value="Sombras" {{ old('categoria') == 'Sombras' ? 'selected' : '' }}>Sombras</option>
                    <option value="Máscara para cílios (rímel)" {{ old('categoria') == 'Máscara para cílios (rímel)' ? 'selected' : '' }}>Máscara para cílios (rímel)</option>
                    <option value="Delineadores" {{ old('categoria') == 'Delineadores' ? 'selected' : '' }}>Delineadores</option>
                    <option value="Batons e gloss" {{ old('categoria') == 'Batons e gloss' ? 'selected' : '' }}>Batons e gloss</option>
                    <option value="Blush e bronzer" {{ old('categoria') == 'Blush e bronzer' ? 'selected' : '' }}>Blush e bronzer</option>
                    <option value="Iluminadores" {{ old('categoria') == 'Iluminadores' ? 'selected' : '' }}>Iluminadores</option>
                    <option value="Cabelos" {{ old('categoria') == 'Cabelos' ? 'selected' : '' }}>Cabelos</option>
                    <option value="Shampoos" {{ old('categoria') == 'Shampoos' ? 'selected' : '' }}>Shampoos</option>
                    <option value="Óleos capilares" {{ old('categoria') == 'Óleos capilares' ? 'selected' : '' }}>Óleos capilares</option>
                    <option value="Tinturas e colorações" {{ old('categoria') == 'Tinturas e colorações' ? 'selected' : '' }}>Tinturas e colorações</option>
                    <option value="Produtos para alisamento ou cachos" {{ old('categoria') == 'Produtos para alisamento ou cachos' ? 'selected' : '' }}>Produtos para alisamento ou cachos</option>
                    <option value="Cuidados com o Corpo" {{ old('categoria') == 'Cuidados com o Corpo' ? 'selected' : '' }}>Cuidados com o Corpo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" id="imagem" name="imagem" class="form-control">
            </div>

            <div class="mb-3">
    <label for="imagens_adicionais" class="form-label">Imagens Adicionais - Max 3</label>
    <input type="file" id="imagens_adicionais" name="imagens_adicionais[]" class="form-control" multiple accept="image/*" onchange="validateFileCount(this)">
</div>

<script>
    function validateFileCount(input) {
        if (input.files.length > 3) {
            alert('Você só pode enviar no máximo 3 imagens adicionais.');
            input.value = ''; // Limpa o campo de input
        }
    }
</script>


            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="ativo" id="ativo" value="1" class="form-check-input" {{ old('ativo', true) ? 'checked' : '' }}>
                    <label for="ativo" class="form-check-label">Ativo</label>
                </div>
                @error('ativo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input type="text" id="tags" name="tags" class="form-control" value="{{ old('tags') }}">
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
