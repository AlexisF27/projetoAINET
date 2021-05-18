<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function admin_index(){
        $todosUsers = User::all();
        return view('users.admin', compact('todosUsers'));
    }
}
