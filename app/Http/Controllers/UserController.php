<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function admin_index(Request $request){
        $selectedTipo= $request->tipo ?? '';
        $selectedNomeUser= $request->name ?? '';
        $selectedEmail = $request->email ?? '';
        $user = Auth::user();
        $qry = User::query();
        if ($selectedTipo) {
            $qry->where('tipo', $selectedTipo);
        }
        if($selectedNomeUser){
            $qry->where('name', $selectedNomeUser);
        }
        if($selectedEmail){
            $qry->where('email', $selectedEmail);
        }
        $lista_tipos = array( 'C', 'F', 'A');
        $todosUsers = $qry->paginate(10);
        return view('users.admin',
            compact('todosUsers',
                    'user',
                    'lista_tipos',
                    'selectedNomeUser',
                    'selectedTipo',
                    'selectedEmail'));
    }

    public function create(){
        $newUser = new User();
        $lista_tipo = array( 'C', 'F', 'A');
        return view('encomendas.create',compact('newEstampa','lista_tipo', 'lista_tipo_pagamento'));
    }

}
