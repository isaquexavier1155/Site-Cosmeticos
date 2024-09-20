<div class="col-md-12 mb-3">
    <div class="card">
        <div class="card-body">
            {{-- Exibir as informações principais com ícone para expandir detalhes --}}
            <div class="d-flex justify-content-between align-items-center">
                <div>
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
                    <p class="card-text"><strong>Enviar via: {{ $sale['freteselecionado'] }}</strong></p>
                    {{-- Exibir valor total --}}
                    <p class="card-text"><strong>Valor Total:</strong> R$
                        {{ number_format($sale['valor_total'], 2, ',', '.') }}
                    </p>
                </div>
                {{-- Ícone para expandir detalhes dos produtos --}}
                <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#detalhesVenda{{ $sale['id'] }}" aria-expanded="false">
                    <!-- Ícone de expansão -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path
                            d="M1.5 6.5a.5.5 0 0 1 .708-.707L8 10.293l5.792-5.792a.5.5 0 0 1 .708.707L8 11.707 1.5 6.5z" />
                    </svg>
                </button>
                {{-- Botão de impressão --}}
                <!--                 @if(isset($sale['etiqueta_url']) && $sale['etiqueta_url'])
                    <a href="{{ $sale['etiqueta_url'] }}" target="_blank" class="btn btn-primary ms-2">Imprimir Etiquetaaa</a>
                @endif -->
            </div>

            {{-- Status no canto inferior direito --}}
            <div class="d-flex justify-content-end">
                <form action="{{ route('sales.updateStatus', $sale['id']) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="d-flex align-items-center">
                        <p class="card-text mb-0"><strong>Status:</strong></p>
                        <select name="status" class="form-select form-select-sm w-auto ms-2">
                            <option value="A preparar" {{ $sale['status'] == 'A preparar' ? 'selected' : '' }}>A preparar
                            </option>
                            <option value="Em trânsito" {{ $sale['status'] == 'Em trânsito' ? 'selected' : '' }}>Em
                                trânsito</option>
                            <option value="Entregue" {{ $sale['status'] == 'Entregue' ? 'selected' : '' }}>Entregue
                            </option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm ms-2">Alterar</button>
                    </div>
                </form>
            </div>

            


            {{-- Detalhes da venda (produtos) --}}
            <div class="collapse mt-3" id="detalhesVenda{{ $sale['id'] }}">
                <div class="row">
                    @foreach ($sale['products'] as $product)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->nome }}</h5>
                                    <p class="card-text"><strong>Quantidade:</strong> {{ $product->quantidade }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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