<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    //
    public function admin_index(){
        $todosClientes = Cliente::all();
        return view('clientes.admin', compact('todosClientes'));
    }
}
