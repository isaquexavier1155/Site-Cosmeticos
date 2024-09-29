<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\FreteController;
use App\Http\Controllers\PainelAdministrativoController;


/* Route::get('/', function () {
    return view('welcome');
}); */

// Rota para a página inicial
Route::get('/', [ProdutoController::class, 'index'])->name('index');




Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');




// Rota para exibir a busca filtrada na view index
Route::get('/busca', [ProdutoController::class, 'busca'])->name('busca');


//rota abaixo inpedia rota produtos create de ser exibida
//inverti a ordem para resolver o conflito
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produtos.show');
//->can('admin'); - para ver somente pelo admin
/*  
Route::get('/produto/{id}', [ProdutoController::class, 'show']); */
/* 
Route::get('/produtos/get/{id}', [ProdutoController::class, 'getProdutoById'])->name('produtos.get'); */
// Exemplo de rota em `web.php`
//Route::post('/save-product-info', [ProdutoController::class, 'saveProductInfo']);

/* buscar produto por categoria
 */Route::get('/buscar-por-categoria', [ProdutoController::class, 'buscarPorCategoria'])->name('buscarPorCategoria');

/* Rota para adicionar produtos ao Carrinho de compras - Login Obrigatorio
 */
    Route::post('/carrinho/adicionar', [ProdutoController::class, 'adicionar'])->name('carrinho.adicionar');

    //Rota para remover itens do carrinho de compras e da tabela cart do banco de dados

    // Rota para remover item do carrinho
    Route::delete('/carrinho/remover/{id}', [ProdutoController::class, 'remove'])->name('carrinho.remover');

//ROTAS PARA INTEGRÇÃO COM SISTEMA DE PAGAMENTO DO MERCADO PAGO


// Exibe o formulário de pagamento com o Payment Brick
/* Route::get('/pagamento', function () {
    return view('pagamento');
}); */

//Route::get('/pagamento', [PagamentoController::class, 'viewPagamento']);



//Route::post('/api/criar-pagamento', [PagamentoController::class, 'criarPagamento']);
Route::get('/pagamento/sucesso', [PagamentoController::class, 'sucesso'])->name('pagamento.sucesso');
Route::get('/pagamento/falha', [PagamentoController::class, 'falha'])->name('pagamento.falha');
Route::get('/pagamento/pendente', [PagamentoController::class, 'pendente'])->name('pagamento.pendente');

// Retorna parâmetro preference_id necessário para processar requisição
//Route::get('/payment/preference', [PagamentoController::class, 'getPreference']);

//Exibe view pagamento.blade.php enviando alguns dados pela controller
Route::post('/payment', [PagamentoController::class, 'showPagamento'])
->name('payment')
->middleware('auth');

//Para limitar acesso a rotas sem ser Administrador
//Somente adoministradores acessam essas rotas
/* Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [ProdutoController::class, 'index'])->name('admin.index');
    // Adicione outras rotas admin aqui
}); */

//Rota acionada ao clicar em Pagar na página onde é gerado formulario de pagamento Bricks
Route::post('/processar-pagamento', [PagamentoController::class, 'processarPagamento'])
->name('processarpagamento')
->middleware('auth');

//Resposanvel por fazer GET para Mercado pago e buscar status do pagamento pelo ID
Route::get('/verificarstatuspagamento', [PagamentoController::class, 'verificarStatusPagamento']);

Route::get('/payment-success', function () {
    return view('sucesso-pagamento'); // Ajuste para o caminho correto da sua view de sucesso
});

Route::get('/buscar-saldo-carteira', [PainelAdministrativoController::class, 'buscaSaldoCarteira'])->name('buscar-saldo-carteira');



//rota para salvar dados adicionais de entrega na tabela users com usuário já logado
Route::post('/checkout-entrega/salvar', [FreteController::class, 'salvarDadosEntrega'])->name('checkout.entrega.salvar');

// routes/web.php ou routes/api.php
use App\Http\Controllers\PaymentController;

Route::post('/salvar-status-pagamento', [PagamentoController::class, 'salvarStatusPagamento'])
->middleware('auth');


// web.php

Route::get('/checkout-entrega', [FreteController::class, 'retornaDadosEntrega'])->name('checkout-entrega');
Route::post('/salvar-dados-entrega', [FreteController::class, 'salvarDadosEntrega'])->name('salvar-dados-entrega');


//rota para aclacular frete dos produtos
Route::post('/calcular-frete', [FreteController::class, 'calcularFrete'])->name('calcular-frete');

// Rota para o Painel Administrativo
Route::get('/my_account', [PainelAdministrativoController::class, 'index'])
    ->name('painel-administrativo')
    ->middleware('auth');

//Rota para atualizar status manualmente no painel administrativo
//Route::patch('/sales/{id}/status', [PainelAdministrativoController::class, 'updateStatus'])->name('sales.updateStatus');

//Rota para gerar a etiqueta de envio de mercadoria
Route::post('/gerar-etiqueta/{saleId}', [PainelAdministrativoController::class, 'gerarEtiquetaCompleta'])->name('painel.gerarEtiqueta');

//Rota para passar compras do usuário LOgado
Route::get('my_acout/purchases', [PainelAdministrativoController::class, 'minhasCompras'])->name('painel.minhas-compras');

//rota para rastrear envio de produtos na aba minhas Compras
Route::get('/rastrear-envio/{id}', [PainelAdministrativoController::class, 'rastrearEnvio'])->name('rastrear.envio');

/* ////////////////////////////////////////////////////////////////////////////////////////////////////////
Rotas criadas automaticamente ao instalar sistema de autenticação:
 */
use App\Http\Controllers\ProfileController;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
