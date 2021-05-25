<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use Illuminate\Http\Request;

class EncomendaController extends Controller
{
    public function index(){
        $todasEncomendas = Encomenda::all();
        return view('encomendas.index', compact('todasEncomendas'));
    }
}
