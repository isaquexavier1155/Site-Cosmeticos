<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

        .mt-2 {
            margin-top: .5rem !important;
            margin-bottom: 1.5rem !important;
        }

        .nav-tabs .nav-link {
            color: #6c757d;
        }

        .nav-tabs .nav-link.active {
            background-color: #E4AFAF;
            color: #fff;
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
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            box-shadow: none;
            transition: all 0.3s ease;
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
            margin-bottom: 10px;
        }

        .text-danger {
            font-size: 0.9em;
            color: #e74c3c;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                max-width: 100%;
            }

            h1 {
                font-size: 1.75rem;
            }

            h3 {
                font-size: 1.25rem;
            }
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs justify-content-center" id="adminTab" role="tablist">
            <!-- Se usuário é admin exibe a aba Minhas vendas -->
            @if(auth()->user()->isAdmin())
                <li class="nav-item">
                    <button class="nav-link active" id="vendas-tab" data-bs-toggle="tab" data-bs-target="#vendas"
                        type="button">Minhas Vendas</button>
                </li>
                <!-- <li class="nav-item">
                        <button class="nav-link" id="compras-tab" data-bs-toggle="tab" data-bs-target="#compras"
                            type="button">Minhas Compras</button>
                    </li> -->
                <li class="nav-item">
                    <button class="nav-link" id="produtos-tab" data-bs-toggle="tab" data-bs-target="#produtos"
                        type="button">Cadastro de Produtos</button>
                </li>
            @else
                <li class="nav-item">
                    <button class="nav-link active" id="compras-tab" data-bs-toggle="tab" data-bs-target="#compras"
                        type="button">Minhas Compras</button>
                </li>
                <!--                 <li class="nav-item">
                            <button class="nav-link" id="produtos-tab" data-bs-toggle="tab" data-bs-target="#produtos"
                                type="button">Cadastro de Produtos</button>
                        </li> -->
            @endif

        </ul>

        <!-- Tab panes -->
        <div class="tab-content mt-3">
            @if(auth()->user()->isAdmin())
                <!-- Aba Minhas Vendas -->
                <!-- active aqui -->
                <div class="tab-pane fade show active" id="vendas" role="tabpanel" aria-labelledby="vendas-tab">
                    <ul class="nav nav-tabs" id="vendasSubTab" role="tablist">
                        <li class="nav-item">
                            <!-- active aqui -->
                            <button class="nav-link active" id="a-preparar-tab" data-bs-toggle="tab"
                                data-bs-target="#a-preparar" type="button">A Preparar</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="em-transito-tab" data-bs-toggle="tab" data-bs-target="#em-transito"
                                type="button">Em Trânsito</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="entregues-tab" data-bs-toggle="tab" data-bs-target="#entregues"
                                type="button">Entregues</button>
                        </li>
                    </ul>

                    <!-- Sub Tab panes -->
                    <div class="tab-content mt-3">
                        <!-- Aba A Preparar -->
                        <div class="tab-pane fade show active" id="a-preparar" role="tabpanel">
                            <h3>A Preparar</h3>
                            <div class="row">
                                @forelse ($salesAPreparar as $sale)
                                    @include('partials.sale-card', ['sale' => $sale])
                                @empty
                                    <p class="text-muted">Nenhuma venda a preparar no momento.</p>
                                @endforelse
                            </div>
                        </div>

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



                        <!-- Aba Em Trânsito -->
                        <div class="tab-pane fade" id="em-transito" role="tabpanel">
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
                        <div class="tab-pane fade" id="entregues" role="tabpanel">
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

                <!-- Aba Cadastro de Produtos -->
                <div class="tab-pane fade" id="produtos" role="tabpanel" aria-labelledby="produtos-tab">
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
            @else
                <!-- Aba Minhas Compras -->
                <div class="tab-pane fade show active" id="compras" role="tabpanel" aria-labelledby="compras-tab">
                    <h3>Minhas Compras</h3>
                    <div class="row">
                        @forelse ($montadasCompras as $purchase)
                            <div class="col-md-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            @foreach ($purchase['products'] as $product)
                                                <li class="d-flex align-items-center mb-2">
                                                    <img src="{{ asset('images/products/' . $product->imagem) }}"
                                                        alt="{{ $product->nome }}" class="img-thumbnail me-2"
                                                        style="width: 100px; height: 100px;">
                                                    <div class="d-flex justify-content-between w-100">
                                                        <span>{{ $product->nome }}</span>
                                                        <span class="text-muted" style="font-size: 0.9rem;">Quantidade:
                                                            {{ $product->quantidade }}</span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <p class="card-text">
                                            R${{ number_format($purchase['valor_total'], 2, ',', '.') }}
                                        </p>
                                        <p class="card-ref">ref.{{ $purchase['id'] }}</p>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- @dump($purchase); -->
                                            <span class="rastrear-produto"
                                                onclick="rastrearProduto('{{ $purchase['etiqueta_id'] }}')"
                                                style="cursor: pointer; font-family: 'Arial', sans-serif; color: #007bff; margin-bottom: 1.5rem;">
                                                Onde está meu produto?
                                                <!-- Estou utilizando um js abaixo para fazer a requisição e retornar dados do produto -->
                                            </span>
                                            <i class="fas fa-chevron-down"
                                                onclick="rastrearProduto('{{ $purchase['etiqueta_id'] }}')"
                                                style="cursor: pointer;"></i>
                                        </div>

                                        <style>
                                            .card-ref {
                                                font-size: 12px;
                                            }

                                            .rastrear-produto {
                                                text-decoration: none;
                                                /* Para dar destaque ao texto */
                                                transition: color 0.3s;
                                            }

                                            .rastrear-produto:hover {
                                                color: #0056b3;
                                                /* Cor ao passar o mouse */
                                            }
                                        </style>



                                        <div id="rastreio-{{ $purchase['etiqueta_id'] }}" class="rastreio-info"
                                            style="display:none;"></div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Você não tem compras no momento.</p>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Script para rastrear produto na API da melhor envio -->
    <script>
        function rastrearProduto(id) {
            const rastreioDiv = document.getElementById(`rastreio-${id}`);
            if (rastreioDiv.style.display === 'none') {
                fetch(`/rastrear-envio/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        // Verifica se houve sucesso na requisição e se há dados
                        if (data.status === 'success' && data.data) {
                            let status = data.data.status;

                            // Mapeia os status da Melhor Envio para descrições mais amigáveis
                            switch (status) {
                                case 'pending':
                                    status = 'Pendente';
                                    break;
                                case 'paid':
                                    status = 'Pago';
                                    break;
                                case 'released':
                                    status = 'A Preparar';
                                    break;
                                case 'posted':
                                case 'in transit':
                                    status = 'Em trânsito';
                                    break;
                                case 'delivered':
                                    status = 'Entregue';
                                    break;
                                case 'canceled':
                                    status = 'Cancelado';
                                    break;
                                case 'expired':
                                    status = 'Expirado';
                                    break;
                                case 'suspended':
                                    status = 'Suspenso';
                                    break;
                                default:
                                    status = 'Desconhecido';
                                    break;
                            }

                            // Função para formatar as datas no formato brasileiro
                            function formatDate(dateString) {
                                if (!dateString) return null;
                                const date = new Date(dateString);
                                return date.toLocaleDateString('pt-BR', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric'
                                });
                            }

                            // Cria o conteúdo HTML apenas se os campos existirem
                            let info = `<h6>Status: ${status}</h6>`;

                            if (data.data.tracking) {
                                info += `<p>Rastreamento: ${data.data.tracking}</p>`;
                            }

                            if (data.data.protocol) {
                                info += `<p>Protocolo: ${data.data.protocol}</p>`;
                            }

                            const createdAt = formatDate(data.data.created_at);
                            if (createdAt) {
                                info += `<p>Criado em: ${createdAt}</p>`;
                            }

                            const postedAt = formatDate(data.data.posted_at);
                            if (postedAt) {
                                info += `<p>Postado em: ${postedAt}</p>`;
                            }

                            const deliveredAt = formatDate(data.data.delivered_at);
                            if (deliveredAt) {
                                info += `<p>Entregue em: ${deliveredAt}</p>`;
                            }

                            // Adiciona o link para Melhor Rastreio
                            if (data.data.tracking) {
                                info += `<p><a href="https://melhorrastreio.com.br/rastreio/${data.data.tracking}" target="_blank" style="text-decoration: none; color: #007bff;">Buscar no Melhor Rastreio</a></p>`;
                            }

                            // Se nenhum campo relevante estiver disponível, exibe uma mensagem informativa
                            if (!data.data.tracking && !data.data.protocol && !createdAt && !postedAt && !deliveredAt) {
                                info = `<p>Não foram encontradas informações detalhadas sobre o rastreio no momento.</p>`;
                            }

                            rastreioDiv.innerHTML = info;
                        } else {
                            // Exibe mensagem caso o status seja diferente de "success"
                            rastreioDiv.innerHTML = `<p>Seu produto está a caminho. Em breve novas atualizações.</p>`;
                        }

                        rastreioDiv.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        // Exibe mensagem de erro em caso de falha na requisição
                        rastreioDiv.innerHTML = `<p>Seu produto está a caminho. Em breve novas atualizações.</p>`;
                        rastreioDiv.style.display = 'block';
                    });
            } else {
                rastreioDiv.style.display = 'none';
            }
        }
    </script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Limita Imagens adicionais em 3-->
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


    <!-- <script src="{{ asset('js/app.js') }}"></script> -->

</body>

</html>