<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstampaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TshirtController;
use App\Http\Controllers\EncomendaController;
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


//Catalogo

Route::get('catalogo/',[EstampaController::class, 'index'])->name('estampas.index');
Route::get('tshirt/',[TshirtController::class, 'index'])->name('tshirt.index');
Route::get('encomendas/',[EncomendaController::class, 'index'])->name('encomendas.index');