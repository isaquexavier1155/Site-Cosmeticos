<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tagify CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">

    <!-- Tagify JS -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>


    <style>
        body {
            background-color: #1f261d;
            font-family: 'Poppins', sans-serif;
        }


        h1,
        h3 {
            color: white;
            font-weight: bold;
        }

        .nav-tabs .nav-link {
            color: #6c757d;
        }

        .nav-tabs .nav-link.active {
            color: black;
            color: #1f261d;
            border: none;
        }

        .tab-pane {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-primary {
            background-color: #E4AFAF;
            border-color: #E4AFAF;
        }

        .btn-primary:hover {
            background-color: #C98585;
            border-color: #C98585;
        }

        .form-control,
        .table {
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .container {
            max-width: 60%;
            margin: 0 auto;
        }

        .form-container {
            background-color: #1f261d;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container .form-label {
            color: #fff;
        }

        .form-container .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .form-container .btn-primary {
            background-color: #E4AFAF;
            border-color: #E4AFAF;
        }

        .form-container .btn-primary:hover {
            background-color: #C98585;
            border-color: #C98585;
        }

        .form-container .text-danger {
            color: #e74c3c;
        }

        /* Sub-nav tabs */
        .nav-tabs .nav-link {
            color: #6c757d;
        }

        .nav-tabs .nav-link.active {
            background-color: #E4AFAF;
            color: #fff;
            border: none;
        }

        .nav-tabs {
            border-bottom: 2px solid #E4AFAF;
        }

        .tab-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }


        /* Responsividade */
        @media (max-width: 768px) {
            h1 {
                font-size: 1.75rem;
            }

            h3 {
                font-size: 1.25rem;
            }

            .tab-pane {
                padding: 15px;
            }

            .table-responsive {
                margin-top: 15px;
            }

            .container {
                max-width: 100%;
            }
        }

        /* Estilo Moderno do Formulário */
        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            transition: all 0.3s ease;
            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .container form {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .text-danger {
            font-size: 0.9em;
        }

        .form-control::placeholder {
            color: #aaa;
            opacity: 0.8;
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <!-- <h1 class="mb-4 text-center">Cadastro - Minhas Vendas - Minhas Compras</h1> -->
        <!-- Nav tabs -->
        <ul class="nav nav-tabs justify-content-center" id="adminTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="vendas-tab" data-bs-toggle="tab" data-bs-target="#vendas"
                    type="button" role="tab" aria-controls="vendas" aria-selected="false">Minhas Vendas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="compras-tab" data-bs-toggle="tab" data-bs-target="#compras" type="button"
                    role="tab" aria-controls="compras" aria-selected="false">Minhas Compras</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="produtos-tab" data-bs-toggle="tab" data-bs-target="#produtos" type="button"
                    role="tab" aria-controls="produtos" aria-selected="true">Cadastro de Produtos</button>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content mt-3">


            <!-- Aba Minhas Vendas -->
            <div class="tab-pane fade show active" id="vendas" role="tabpanel" aria-labelledby="vendas-tab">
                <ul class="nav nav-tabs" id="vendasSubTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="a-preparar-tab" data-bs-toggle="tab"
                            data-bs-target="#a-preparar" type="button" role="tab" aria-controls="a-preparar"
                            aria-selected="true">A Preparar</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="em-transito-tab" data-bs-toggle="tab" data-bs-target="#em-transito"
                            type="button" role="tab" aria-controls="em-transito" aria-selected="false">Em
                            Trânsito </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="entregues-tab" data-bs-toggle="tab" data-bs-target="#entregues"
                            type="button" role="tab" aria-controls="entregues" aria-selected="false">Entregues</button>
                    </li>
                </ul>

                <!-- Sub Tab panes -->
                <div class="tab-content mt-3">
                    <!-- Aba A Preparar -->
                    <div class="tab-pane fade show active" id="a-preparar" role="tabpanel"
                        aria-labelledby="a-preparar-tab">
                        <h3>A Preparar</h3>
                        <div class="row">
                            <!-- Usando componente externo chamado sale-card.blade que vem da pasta partials -->
                            @forelse ($salesAPreparar as $sale)
                                @include('partials.sale-card', ['sale' => $sale])
                                {{-- Botão de gerar e imprimir etiqueta --}}
                                <div class="d-flex justify-content-end mt-2">
                                    @if (isset($sale['etiqueta_url']) && $sale['etiqueta_url'])
                                        <a href="{{ $sale['etiqueta_url'] }}" class="btn btn-secondary btn-sm ms-2"
                                            target="_blank">Imprimir Etiqueta</a>
                                    @else
                                        <form action="{{ route('painel.gerarEtiqueta', $sale['id']) }}" method="POST"
                                            class="gerar-etiqueta-form" data-sale-id="{{ $sale['id'] }}">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Gerar Etiqueta</button>
                                        </form>
                                    @endif
                                </div>
                                <!-- @dump($sale['id']);
                                @dump(session('success'));
                                @dump(session('sale_id')); -->

                                {{-- Mensagens de sucesso e erro específicas para cada venda --}}
                                @if (session('sale_id') == $sale['id'] && session('success'))
                                    <div id="mensagem-sucesso-{{ $sale['id'] }}" class="alert alert-success mt-3">
                                        {!! session('success') !!}
                                    </div>
                                @endif

                                @if (session('sale_id') == $sale['id'] && session('error'))
                                    <div id="mensagem-erro-{{ $sale['id'] }}" class="alert alert-danger mt-3">
                                        {!! session('error') !!}
                                    </div>
                                @endif

                            @empty
                                <p class="text-muted">Nenhuma venda a preparar no momento.</p>
                            @endforelse

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    // Verificar se existe uma mensagem de sucesso ou erro e rolar até ela na venda correspondente
                                    const forms = document.querySelectorAll('.gerar-etiqueta-form');

                                    forms.forEach(form => {
                                        form.addEventListener('submit', function () {
                                            const saleId = this.getAttribute('data-sale-id');
                                            scrollToMessage(saleId);
                                        });
                                    });

                                    function scrollToMessage(saleId) {
                                        const mensagemSucesso = document.getElementById('mensagem-sucesso-' + saleId);
                                        const mensagemErro = document.getElementById('mensagem-erro-' + saleId);

                                        if (mensagemSucesso) {
                                            mensagemSucesso.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                        } else if (mensagemErro) {
                                            mensagemErro.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                        }
                                    }

                                    // Se houver uma mensagem de sucesso ou erro ao carregar a página, rola para ela
                                    @foreach ($salesAPreparar as $sale)
                                        scrollToMessage({{ $sale['id'] }});
                                    @endforeach
                                });
                            </script>




                        </div>
                    </div>




                    <!-- Aba Em Trânsito -->
                    <div class="tab-pane fade" id="em-transito" role="tabpanel" aria-labelledby="em-transito-tab">
                        <h3>Em Trânsito</h3>
                        <div class="row">
                            @forelse ($salesEmTransito as $sale)
                                @include('partials.sale-card', ['sale' => $sale])
                            @empty
                                <p class="text-muted">Nenhuma venda em trânsito no momento.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Aba Entregue -->
                    <div class="tab-pane fade" id="entregues" role="tabpanel" aria-labelledby="entregues-tab">
                        <h3>Entregues</h3>
                        <div class="row">
                            @forelse ($salesEntregue as $sale)
                                @include('partials.sale-card', ['sale' => $sale])
                            @empty
                                <p class="text-muted">Nenhuma venda entregue no momento.</p>
                            @endforelse
                        </div>
                    </div>
                </div>




            </div>

            <!-- Aba Minhas Compras -->
            <div class="tab-pane fade" id="compras" role="tabpanel" aria-labelledby="compras-tab">
                <h3>Minhas Compras</h3>
                <!-- Adicione a lógica e o conteúdo para a aba "Minhas Compras" aqui -->
            </div>
            <!-- Aba Cadastro de Produtos -->
            <div class="tab-pane fade " id="produtos" role="tabpanel" aria-labelledby="produtos-tab">
                <h3>Cadastro de Produtos</h3>
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
                        <textarea name="modo_de_usar" id="modo_de_usar" class="form-control"
                            rows="3">{{ old('modo_de_usar') }}</textarea>
                        @error('modo_de_usar')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="caracteristicas" class="form-label">Características:</label>
                        <textarea placeholder="Digite um item e pressione enter" name="caracteristicas"
                            id="caracteristicas" class="form-control" rows="3">{{ old('caracteristicas') }}</textarea>
                        @error('caracteristicas')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço Normal:</label>
                        <input type="number" name="preco" id="preco" class="form-control" step="0.01" required>
                        @error('preco')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="preco_promocional" class="form-label">Preço Promocional:</label>
                        <input type="number" name="preco_promocional" id="preco_promocional" class="form-control"
                            step="0.01" required>
                        @error('preco_promocional')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantidade_estoque" class="form-label">Quantidade em Estoque:</label>
                        <input type="number" name="quantidade_estoque" id="quantidade_estoque" class="form-control"
                            required>
                        @error('quantidade_estoque')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <select id="categoria" name="categoria" class="form-select" required>
                            <option value="">Selecione a Categoria</option>
                            <option value="Perfumes" {{ old('categoria') == 'Perfumes' ? 'selected' : '' }}>Perfumes
                            </option>
                            <option value="Body splash" {{ old('categoria') == 'Body splash' ? 'selected' : '' }}>Body
                                splash
                            </option>
                            <option value="Hidratantes" {{ old('categoria') == 'Hidratantes' ? 'selected' : '' }}>
                                Hidratantes
                            </option>
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
                        <input type="file" name="imagens_adicionais[]" id="imagens_adicionais" class="form-control"
                            accept="image/*" multiple required>
                        @error('imagens_adicionais.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>