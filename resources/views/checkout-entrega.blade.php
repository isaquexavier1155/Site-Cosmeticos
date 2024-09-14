<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados de Entrega</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

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
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Dados de Entrega</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('salvar-dados-entrega') }}" method="POST">
        @csrf
    <!-- Campos do formulário -->
    <div class="mb-3">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', auth()->user()->name) }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" name="cpf" id="cpf" class="form-control" value="{{ old('cpf', auth()->user()->cpf) }}" required>
    </div>
    <div class="mb-3">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" name="celular" id="celular" class="form-control" value="{{ old('celular', auth()->user()->celular) }}" required>
    </div>
    <div class="mb-3">
        <label for="cep" class="form-label">CEP</label>
        <input type="text" name="cep" id="cep" class="form-control" value="{{ old('cep', auth()->user()->cep) }}" required>
    </div>
    <div class="mb-3">
        <label for="rua" class="form-label">Rua</label>
        <input type="text" name="rua" id="rua" class="form-control" value="{{ old('rua', auth()->user()->rua) }}" required>
    </div>
    <div class="mb-3">
        <label for="numero" class="form-label">Número</label>
        <input type="text" name="numero" id="numero" class="form-control" value="{{ old('numero', auth()->user()->numero) }}" required>
    </div>
    <div class="mb-3">
        <label for="complemento" class="form-label">Complemento</label>
        <input type="text" name="complemento" id="complemento" class="form-control" value="{{ old('complemento', auth()->user()->complemento) }}">
    </div>
    <div class="mb-3">
        <label for="bairro" class="form-label">Bairro</label>
        <input type="text" name="bairro" id="bairro" class="form-control" value="{{ old('bairro', auth()->user()->bairro) }}" required>
    </div>
    <div class="mb-3">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" name="cidade" id="cidade" class="form-control" value="{{ old('cidade', auth()->user()->cidade) }}" required>
    </div>
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <input type="text" name="estado" id="estado" class="form-control" value="{{ old('estado', auth()->user()->estado) }}" required>
    </div>

    <input type="hidden" name="amount" value="{{ session('total_geral') }}">

    <button type="submit" class="btn btn-primary">Continuar</button>
</form>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
