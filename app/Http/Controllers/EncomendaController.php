<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EncomendaController extends Controller
{
    //
    public function index(Request $request){
        $selectedEstado = $request->estado ?? '';
        $user = Auth::user();
        $qry = Encomenda::query();
        if ($selectedEstado) {
            $qry->where('estado', $selectedEstado);
        }
        $lista_estados = array( 'pendente', 'paga', 'fechada', 'anulada');
        $todasEncomendas = $qry->paginate(10);
        return view('encomendas.index', compact('selectedEstado','user','todasEncomendas','lista_estados'));
    }
}
