<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [ProdutoController::class, 'index']);

Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');

//rota abaixo inpedia rota produtos create de ser exibida
//inverti a ordem para resolver o conflito
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produtos.show');

/*  
Route::get('/produto/{id}', [ProdutoController::class, 'show']); */
/* 
Route::get('/produtos/get/{id}', [ProdutoController::class, 'getProdutoById'])->name('produtos.get'); */
// Exemplo de rota em `web.php`
//Route::post('/save-product-info', [ProdutoController::class, 'saveProductInfo']);

