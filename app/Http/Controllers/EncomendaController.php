<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use Illuminate\Http\Request;

class EncomendaController extends Controller
{
    public function index(Request $request){
       
        $todasEncomendas = Encomenda::paginate(10);
        return view('encomendas.index', compact('todasEncomendas'));
    }
    public function create(){
        $newEncomenda = new Encomenda();
        

    }

    public function anular_encomenda(Encomenda $encomenda)
    {
       
        try {
            $encomenda->delete();
            
            return redirect()->route('encomendas.index')
                 ->with('alert-msg', 'Encomenda ID  "' . $encomenda->id . '" anulada com sucesso!')
                ->with('alert-type', 'success'); 
                
        } catch (\Throwable $th) {
            
        }
    }
}
