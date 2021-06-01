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

Route::get('/', [PageController::class ,'index']);
Route::get('admin/clientes', [ClienteController::class, 'admin_index'])->name('admin.clientes');
Route::get('admin/users', [UserController::class, 'admin_index'])->name('admin.users');

//Login
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//Catalogo


Route::get('catalogo/',[EstampaController::class, 'index'])->name('estampas.index');
Route::post('catalogo/', [EstampaController::class, 'store'])->name('estampas.store');
Route::put('catalogo/estampa/{estampa}', [EstampaController::class, 'update'])->name('estampas.update');
Route::get('catalogo/estampa/{estampa}/edit',[EstampaController::class, 'edit'])->name('estampas.edit');
Route::get('catalogo/create',[EstampaController::class, 'create'])->name('estampas.create');
Route::delete('catalogo/estampa/{estampa}', [EstampaController::class, 'destroy'])->name('estampas.destroy');



