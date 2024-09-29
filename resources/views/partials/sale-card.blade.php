<div class="col-12 col-md-12 mb-3">
    <div class="card">
        <div class="card-body">
            {{-- Exibir as informações principais com ícone para expandir detalhes --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    {{-- Botão de gerar e imprimir etiqueta --}}
                    <div class="d-flex justify-content-end mt-2">
                        @if (isset($sale['etiqueta_url']) && $sale['etiqueta_url'])
                            <!-- <a href="{{ $sale['etiqueta_url'] }}" class="btn btn-secondary btn-sm ms-2"
                                target="_blank">Imprimir Etiqueta</a> -->
                        @else
                           <!--  Para exibir botão de Gerar etiqueta somente na aba a Preparar -->
                            @if($sale['status'] == 'A preparar')
                                <form action="{{ route('painel.gerarEtiqueta', $sale['id']) }}" method="POST"
                                    class="gerar-etiqueta-form" data-sale-id="{{ $sale['id'] }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Gerar Etiqueta</button>
                                </form>
                            @endif

                        @endif
                    </div>

                    {{-- Mensagens de sucesso e erro específicas para cada venda --}}
                    @if (session('sale_id') == $sale['id'] && session('success'))
                        <div id="mensagem-sucesso-{{ $sale['id'] }}" class="alert alert-success mt-3">
                            {!! session('success') !!}
                        </div>
                    @endif

                  <!--   @dump(session('sale_id'));
                    @dump($sale['id']);
                    @dump(session('error')); -->

          <!--           @if (session('error'))
                        <div id="mensagem-erro-{{ $sale['id'] }}" class="alert alert-danger mt-3">
                            {!! session('error') !!}
                        </div>
                    @endif -->
                    

                    @if (session('sale_id') == $sale['id'] && session('error'))
                        <div id="mensagem-erro-{{ $sale['id'] }}" class="alert alert-danger mt-3">
                            {!! session('error') !!}
                        </div>
                    @endif

                    <h5 class="card-title">Venda #{{ $sale['id'] }} -
                        {{ \Carbon\Carbon::parse($sale['created_at'])->format('d/m/Y') }}
                    </h5>
                    {{-- Exibir informações do comprador --}}
                    <p class="card-text"><strong>Comprador:</strong> {{ $sale['user']->name ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $sale['user']->email ?? 'N/A' }}</p>
                    {{-- Exibir informações de entrega --}}
                    <p class="card-text"><strong>Endereço de Entrega:</strong> {{ $sale['user']->rua ?? 'N/A' }},
                        {{ $sale['user']->cidade ?? 'N/A' }}, {{ $sale['user']->estado ?? 'N/A' }},
                        {{ $sale['user']->cep ?? 'N/A' }}
                    </p>
                    <p class="card-text"><strong>Enviar via:</strong> {{ $sale['freteselecionado'] }}</p>
                    {{-- Exibir valor total --}}
                    <p class="card-text"><strong>Valor Total:</strong> R$
                        {{ number_format($sale['valor_total'], 2, ',', '.') }}
                    </p>
                </div>

                {{-- Ícone para expandir detalhes dos produtos --}}
                <button class="btn btn-link p-0 mt-3 mt-md-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#detalhesVenda{{ $sale['id'] }}" aria-expanded="false">
                    <!-- Ícone de expansão -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path
                            d="M1.5 6.5a.5.5 0 0 1 .708-.707L8 10.293l5.792-5.792a.5.5 0 0 1 .708.707L8 11.707 1.5 6.5z" />
                    </svg>
                </button>
            </div>

            {{-- Detalhes da venda (produtos) --}}
            <div class="collapse mt-3" id="detalhesVenda{{ $sale['id'] }}">
                <!-- <div class="row">
                    @foreach ($sale['products'] as $product)
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->nome }}</h5>
                                    <p class="card-text"><strong>Quantidade:</strong> {{ $product->quantidade }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale['products'] as $product)
                            <tr>
                                <td>{{ $product->nome }}</td>
                                <td>{{ $product->quantidade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>