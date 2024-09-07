<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

/* Route::get('/', function () {
    return view('welcome');
}); */

// Rota para a página inicial
Route::get('/', [ProdutoController::class, 'index']);

Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');




// Rota para exibir a busca filtrada na view index
Route::get('/busca', [ProdutoController::class, 'busca'])->name('busca');


//rota abaixo inpedia rota produtos create de ser exibida
//inverti a ordem para resolver o conflito
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produtos.show');

/*  
Route::get('/produto/{id}', [ProdutoController::class, 'show']); */
/* 
Route::get('/produtos/get/{id}', [ProdutoController::class, 'getProdutoById'])->name('produtos.get'); */
// Exemplo de rota em `web.php`
//Route::post('/save-product-info', [ProdutoController::class, 'saveProductInfo']);

/* buscar produto por categoria
 */Route::get('/buscar-por-categoria', [ProdutoController::class, 'buscarPorCategoria'])->name('buscarPorCategoria');

/* Rota para adicionar produtos ao Carrinho de compras
 */
Route::post('/carrinho/adicionar', [ProdutoController::class, 'adicionar'])->name('carrinho.adicionar');



/* Rotas criadas automaticamente ao instalar sistema de autenticação:

 */
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
