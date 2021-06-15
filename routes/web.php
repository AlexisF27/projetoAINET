<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstampaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\TshirtController;

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


//Login
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
Route::get('carrinho/', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('carrinho/estampa/{estampa}', [CarrinhoController::class, 'store_t_shirt'])->name('carrinho.store_t_shirt');
Route::put('carrinho/estampas/{estampa}', [CarrinhoController::class, 'update_t_shirt'])->name('carrinho.update_t_shirt');
//--Prueba
Route::get('carrinho/estampas/{estampa}/tshirt/{tshirt}/edit',[CarrinhoController::class, 'editar_t_shirt'])->name('carrinho.editar_t_shirt');
Route::put('carrinho/estampas/{estampa}/tshirt/',[CarrinhoController::class, 'update'])->name('carrinho.update');
//--Prueba
Route::delete('carrinho/tshirt/estampa/{estampa}', [CarrinhoController::class, 'destroy_t_shirt'])->name('carrinho.destroy_t_shirt');
Route::post('carrinho', [CarrinhoController::class, 'store'])->name('carrinho.store');
Route::delete('carrinho', [CarrinhoController::class, 'destroy'])->name('carrinho.destroy');
//Tshirt
Route::get('tshirt/create', [TshirtController::class, 'create'])->name('tshirts.create');
Route::get('tshirt/{tshirt}/edit', [TshirtController::class, 'edit'])->name('tshirts.edit');
Route::put('tshirt/{tshirt}', [TshirtController::class, 'update'])->name('tshirts.update');

//Users
Route::middleware(['auth'])->group(function () {
    Route::get('admin/users/', [UserController::class, 'admin_index'])
        ->name('admin.users')
        ->middleware('can:view,App\Models\User');
    Route::get('admin/users/create', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('can:create,App\Models\User');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('can:view,App\Models\User');
    Route::post('admin/users/', [UserController::class, 'store'])
        ->name('users.store')
        ->middleware('can:store,App\Models\User');
    Route::put('admin/users/',[UserController::class, 'update'])
        ->name('users.update')
        ->middleware('can:update,App\Models\User');
    Route::put('admin/users/{user}',[UserController::class, 'updateBloqueado'])
        ->name('users.updateBloqueado')
        ->middleware('can:view,App\Models\Encomenda');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('can:delete,App\Models\User');
    Route::get('admin/estatisticas',[UserController::class, 'index_estatisticas'])
        ->name('users.estatisticas')
        ->middleware('can:view,App\Models\User');
});
//Encomendas
Route::middleware(['auth'])->group(function () {
    Route::get('encomendas/', [EncomendaController::class, 'index'])->name('encomendas.index');
    Route::get('encomendas/funcionario/detalhes/{encomenda}',[EncomendaController::class, 'index_funcionario'])
        ->name('encomendas.index_funcionario')
        ->middleware('can:viewFuncionario,App\Models\Encomenda');
    Route::put('encomendas/{encomenda}',[EncomendaController::class, 'updateEstado'])
        ->name('encomendas.updateEstado')
        ->middleware('can:updateEstado,App\Models\Encomenda');
    Route::post('encomendas/', [EncomendaController::class, 'store'])
        ->name('encomendas.store')
        ->middleware('can:store,App\Models\Encomenda');
    Route::get('encomendas/{encomenda}/edit', [EncomendaController::class, 'edit'])
        ->name('encomendas.edit')
        ->middleware('can:viewFuncionario,App\Models\Encomenda');
    Route::put('encomendas/{encomenda}',[EncomendaController::class, 'update'])
        ->name('encomendas.update')
        ->middleware('can:update,App\Models\Encomenda');
    Route::delete('encomendas/{encomenda}', [EncomendaController::class, 'destroy'])
        ->name('encomendas.destroy')
        ->middleware('can:delete,App\Models\Encomenda');
    Route::get('encomendas/create', [EncomendaController::class, 'create'])
        ->name('encomendas.create')
        ->middleware('can:create,App\Models\Encomenda');
});
//Catalogo
Route::middleware(['auth'])->group(function () {
    Route::get('catalogo/', [EstampaController::class, 'index'])
    ->name('estampas.index')
    ->middleware('can:viewAny,App\Models\Estampa');
    Route::get('/', [EstampaController::class, 'index'])
        ->name('estampas.index')
        ->middleware('can:viewAny,App\Models\Estampa');
    Route::post('catalogo/', [EstampaController::class, 'store'])
        ->name('estampas.store')
        ->middleware('can:create,App\Models\Estampa');
    Route::put('catalogo/estampa/{estampa}', [EstampaController::class, 'update'])
        ->name('estampas.update')
        ->middleware('can:update,App\Models\Estampa');
    Route::get('catalogo/estampa/{estampa}/edit', [EstampaController::class, 'edit'])
        ->name('estampas.edit')
        ->middleware('can:view,App\Models\Estampa');
    Route::get('catalogo/create', [EstampaController::class, 'create'])
        ->name('estampas.create')
        ->middleware('can:create,App\Models\Estampa');
    Route::delete('catalogo/estampa/{estampa}', [EstampaController::class, 'destroy'])
        ->name('estampas.destroy')
        ->middleware('can:delete,App\Models\Estampa');
    Route::get('catalogo/cliente/{id}/estampas', [EstampaController::class,'index_clientes'])
        ->name('estampas.index_clientes');
});


