<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use Illuminate\Http\Request;

class EncomendaController extends Controller
{
    public function index(){
        $todasEncomendas = Encomenda::paginate(10);
        return view('encomendas.index', compact('todasEncomendas'));
    }
}
