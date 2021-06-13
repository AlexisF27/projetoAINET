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
        $todasEncomendas = $qry->where('cliente_id', $user->id)->paginate(10);
        return view('encomendas.index', compact('selectedEstado','user','todasEncomendas','lista_estados'));
    }

    public function index_funcionario(Request $request, $id){
        $encomenda = Encomenda::findOrFail($id);
        return view('encomendas.index_funcionario',compact('encomenda'));
    }

    public function updateEstado(Request $request, $id){
        $encomenda = Encomenda::findOrFail($id);
        if($encomenda->estado == 'paga'){
            $msg = 'O estado da encomenda ' . $request->id . ' foi mudado para fechada ';
            $encomenda->estado = 'fechada';
        }
        if($encomenda->estado == 'pendente'){
            $msg = 'O estado da encomenda ' . $request->id . ' foi mudado para pagada ';
            $encomenda->estado = 'paga';
        }
        $encomenda->save();
        return back()
        ->with('alert-msg', 'A encomenda "' . $encomenda->id . '" mudou de estado para "'. $encomenda->estado  .'"!')
        ->with('alert-type', 'warning');
    }
}
