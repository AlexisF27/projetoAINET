<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstampaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index']);
Route::get('admin/clientes', [ClienteController::class, 'admin_index'])->name('admin.clientes');
Route::get('admin/users', [UserController::class, 'admin_index'])->name('admin.users');

//Login
Auth::routes();



Auth::routes();
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes(['verify' => true]);
/*
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/

//Carrinho
Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('carrinho/tshirt/{tshirt}', [CarrinhoController::class, 'store_t_shirt'])->name('carrinho.store_t_shirt');
Route::put('carrinho/disciplinas/{disciplina}', [CarrinhoController::class, 'update_t_shirt'])->name('carrinho.update_t_shirt');
Route::delete('carrinho/disciplinas/{disciplina}', [CarrinhoController::class, 'destroy_t_shirt'])->name('carrinho.destroy_t_shirt');
Route::post('carrinho', [CarrinhoController::class, 'store'])->name('carrinho.store');
Route::delete('carrinho', [CarrinhoController::class, 'destroy'])->name('carrinho.destroy');


//Catalogo
Route::middleware(['auth'])->group(function () {
    Route::get('catalogo/', [EstampaController::class, 'index'])->name('estampas.index')->middleware('can:viewAny,App\Models\Estampa');;
    Route::post('catalogo/', [EstampaController::class, 'store'])->name('estampas.store')->middleware('can:create,App\Models\Estampa');;
    Route::put('catalogo/estampa/{estampa}', [EstampaController::class, 'update'])->name('estampas.update')->middleware('can:update,cliente');;
    Route::get('catalogo/estampa/{estampa}/edit', [EstampaController::class, 'edit'])->name('estampas.edit')->middleware('can:view,cliente');;
    Route::get('catalogo/create', [EstampaController::class, 'create'])->name('estampas.create')->middleware('can:create,App\Models\Estampa');;
    Route::delete('catalogo/estampa/{estampa}', [EstampaController::class, 'destroy'])->name('estampas.destroy')->middleware('can:delete,cliente');;
});


