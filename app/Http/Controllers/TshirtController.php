<?php

namespace App\Http\Controllers;

use App\Models\Cores;
use App\Models\Estampa;
use App\Models\Tshirt;
use Illuminate\Http\Request;

class TshirtController extends Controller
{
    //

    public function create(Estampa $estampa){
        $newTshirt = new Tshirt();
        $lista_cores= Cores::all();
        $tamanhos = array( 'XS', 'S', 'M', 'L', 'XL');
        return view('tshirts.create',compact('newTshirt','lista_cores','estampa','tamanhos'));
    }

    public function edit(Tshirt $tshirt){

    }

    public function update(Request $request, Tshirt $tshirt){
        $dados = $request->validated();
        $tshirt->fill($dados);
        // $tshirt->save();
        return redirect()->route('carrinho.index')
            ->with('alert-msg', 'Tshirt "' . $tshirt->id . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');

    }

}
