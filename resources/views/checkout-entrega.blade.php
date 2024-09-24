<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados de Entrega</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1f261d;

        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-color: #1f261d;
        }


        .container {
            background-color: #546151;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            /* Mantém a largura máxima para telas maiores */
            display: flex;
            flex-direction: column;
            margin: 2rem;
            /* Margin padrão para telas grandes */
        }

        /* Consulta de mídia para telas pequenas */
        @media (max-width: 576px) {
            .container {
                width: 100%;
                /* Garante que o container ocupe 100% da largura */
                padding: 1rem;
                /* Ajuste o padding se necessário */
                margin: 0;
                /* Remove o margin para telas pequenas */
            }
            body {
            padding: 0;
            margin: 0;
        }

        }


        h1 {
            margin-bottom: 1rem;
            text-align: center;
            font-size: 1.1rem;
            color: white;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
        }

        .form-control {
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
            padding: 0.5rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .btn-primary {
            background-color: #546151;
            border: none;
            border-radius: 0.375rem;
            padding: 0.5rem;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #1f261d;
        }

        .alert {
            border-radius: 0.375rem;
            padding: 0.75rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        @media (min-width: 600px) {
            .form-group {
                flex-direction: row;
                justify-content: space-between;
            }

            .form-group .form-control {
                flex: 1;
                margin-right: 0.5rem;
            }

            .form-group .form-control:last-child {
                margin-right: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Revise seus dados</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('salvar-dados-entrega') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome Completo"
                    value="{{ old('nome', auth()->user()->name) }}" required>
            </div>
            <div class="form-group">
                <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                    value="{{ old('email', auth()->user()->email) }}" required>
            </div>
            <div class="form-group">
                <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF"
                    value="{{ old('cpf', auth()->user()->cpf) }}" required>
            </div>
            <div class="form-group">
                <input type="text" name="celular" id="celular" class="form-control" placeholder="Celular"
                    value="{{ old('celular', auth()->user()->celular) }}" required>
            </div>
            <div class="form-group">
                <input type="text" name="cep" id="cep" class="form-control" placeholder="CEP"
                    value="{{ old('cep', auth()->user()->cep) }}" required>
            </div>
            <div class="form-group">
                <input type="text" name="rua" id="rua" class="form-control" placeholder="Rua"
                    value="{{ old('rua', auth()->user()->rua) }}" required>
            </div>
            <div class="form-group">
                <input type="text" name="numero" id="numero" class="form-control" placeholder="Número"
                    value="{{ old('numero', auth()->user()->numero) }}" required>
            </div>
            <div class="form-group">
                <input type="text" name="complemento" id="complemento" class="form-control" placeholder="Complemento"
                    value="{{ old('complemento', auth()->user()->complemento) }}">
            </div>
            <div class="form-group">
                <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro"
                    value="{{ old('bairro', auth()->user()->bairro) }}" required>
            </div>
            <div class="form-group">
                <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade"
                    value="{{ old('cidade', auth()->user()->cidade) }}" required>
            </div>
            <div class="form-group">
                <select name="estado" id="estado" class="form-control" required>
                    <option value="" disabled selected>Selecione o Estado</option>
                    <option value="AC" {{ old('estado', auth()->user()->estado) == 'AC' ? 'selected' : '' }}>Acre</option>
                    <option value="AL" {{ old('estado', auth()->user()->estado) == 'AL' ? 'selected' : '' }}>Alagoas
                    </option>
                    <option value="AP" {{ old('estado', auth()->user()->estado) == 'AP' ? 'selected' : '' }}>Amapá
                    </option>
                    <option value="AM" {{ old('estado', auth()->user()->estado) == 'AM' ? 'selected' : '' }}>Amazonas
                    </option>
                    <option value="BA" {{ old('estado', auth()->user()->estado) == 'BA' ? 'selected' : '' }}>Bahia
                    </option>
                    <option value="CE" {{ old('estado', auth()->user()->estado) == 'CE' ? 'selected' : '' }}>Ceará
                    </option>
                    <option value="DF" {{ old('estado', auth()->user()->estado) == 'DF' ? 'selected' : '' }}>Distrito
                        Federal</option>
                    <option value="ES" {{ old('estado', auth()->user()->estado) == 'ES' ? 'selected' : '' }}>Espírito
                        Santo</option>
                    <option value="GO" {{ old('estado', auth()->user()->estado) == 'GO' ? 'selected' : '' }}>Goiás
                    </option>
                    <option value="MA" {{ old('estado', auth()->user()->estado) == 'MA' ? 'selected' : '' }}>Maranhão
                    </option>
                    <option value="MT" {{ old('estado', auth()->user()->estado) == 'MT' ? 'selected' : '' }}>Mato Grosso
                    </option>
                    <option value="MS" {{ old('estado', auth()->user()->estado) == 'MS' ? 'selected' : '' }}>Mato Grosso
                        do Sul</option>
                    <option value="MG" {{ old('estado', auth()->user()->estado) == 'MG' ? 'selected' : '' }}>Minas Gerais
                    </option>
                    <option value="PA" {{ old('estado', auth()->user()->estado) == 'PA' ? 'selected' : '' }}>Pará</option>
                    <option value="PB" {{ old('estado', auth()->user()->estado) == 'PB' ? 'selected' : '' }}>Paraíba
                    </option>
                    <option value="PR" {{ old('estado', auth()->user()->estado) == 'PR' ? 'selected' : '' }}>Paraná
                    </option>
                    <option value="PE" {{ old('estado', auth()->user()->estado) == 'PE' ? 'selected' : '' }}>Pernambuco
                    </option>
                    <option value="PI" {{ old('estado', auth()->user()->estado) == 'PI' ? 'selected' : '' }}>Piauí
                    </option>
                    <option value="RJ" {{ old('estado', auth()->user()->estado) == 'RJ' ? 'selected' : '' }}>Rio de
                        Janeiro</option>
                    <option value="RN" {{ old('estado', auth()->user()->estado) == 'RN' ? 'selected' : '' }}>Rio Grande do
                        Norte</option>
                    <option value="RS" {{ old('estado', auth()->user()->estado) == 'RS' ? 'selected' : '' }}>Rio Grande do
                        Sul</option>
                    <option value="RO" {{ old('estado', auth()->user()->estado) == 'RO' ? 'selected' : '' }}>Rondônia
                    </option>
                    <option value="RR" {{ old('estado', auth()->user()->estado) == 'RR' ? 'selected' : '' }}>Roraima
                    </option>
                    <option value="SC" {{ old('estado', auth()->user()->estado) == 'SC' ? 'selected' : '' }}>Santa
                        Catarina</option>
                    <option value="SP" {{ old('estado', auth()->user()->estado) == 'SP' ? 'selected' : '' }}>São Paulo
                    </option>
                    <option value="SE" {{ old('estado', auth()->user()->estado) == 'SE' ? 'selected' : '' }}>Sergipe
                    </option>
                    <option value="TO" {{ old('estado', auth()->user()->estado) == 'TO' ? 'selected' : '' }}>Tocantins
                    </option>
                </select>
            </div>


            <input type="hidden" name="amount" value="{{ session('total_geral') }}">
            <input type="hidden" name="produto_ids" value="{{ $produto_ids_str }}">
            <input type="hidden" name="produto_qtds" value="{{ $produto_qtds_str }}">
            <input type="hidden" name="frete_selecionado" value="{{ $frete_selecionado }}">

            <button type="submit" class="btn btn-primary">Continuar</button>
        </form>
    </div>
</body>

</html>