<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstampaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('users/{user}',  [UserController::class, 'profile'])->name('users.profile');
Route::get('users/{user}/edit',  [UserController::class, 'edit'])->name('users.edit');
Route::patch('users/{user}/update',  [UserController::class, 'update'])->name('users.update');
//Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);

//Catalogo
Route::middleware(['auth'])->group(function () {
    Route::get('catalogo/', [EstampaController::class, 'index'])->name('estampas.index')->middleware('can:viewAny,App\Models\Estampa');;
    Route::post('catalogo/', [EstampaController::class, 'store'])->name('estampas.store')->middleware('can:create,App\Models\Estampa');;
    Route::put('catalogo/estampa/{estampa}', [EstampaController::class, 'update'])->name('estampas.update')->middleware('can:update,cliente');;
    Route::get('catalogo/estampa/{estampa}/edit', [EstampaController::class, 'edit'])->name('estampas.edit')->middleware('can:view,cliente');;
    Route::get('catalogo/create', [EstampaController::class, 'create'])->name('estampas.create')->middleware('can:create,App\Models\Estampa');;
    Route::delete('catalogo/estampa/{estampa}', [EstampaController::class, 'destroy'])->name('estampas.destroy')->middleware('can:delete,cliente');;
});
