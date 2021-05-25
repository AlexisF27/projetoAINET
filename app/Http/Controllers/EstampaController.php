<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use App\Models\Categoria;
use Illuminate\Http\Request;

class EstampaController extends Controller
{
    //
    public function index(Request $request){
        $selectedCategoria = $request->categoria ?? '';
        $selectedNomeEstampa = $request->nome ?? '';
        $qry = Estampa::query();
        if ($selectedCategoria) {
            $qry->where('categoria_id', $selectedCategoria);
        }
        if($selectedNomeEstampa){
            $qry->where('nome', $selectedNomeEstampa);
        }
        $todasEstampas = $qry->paginate(10);
        $lista_Categorias = Categoria::pluck('nome','id');
        return view('estampas.index', compact('todasEstampas','selectedCategoria','lista_Categorias','selectedNomeEstampa'));
    }

    public function create(){
        $estampa = new Estampa();
        $lista_categorias = Categoria::all();
        return view('estampas.create',compact('estampa','lista_categorias'));

    }

    public function store(){

    }

    public function update(){

    }

    public function edit(Estampa $estampa){
        $lista_categorias = Categoria::all();
        return view('estampas.edit', compact('estampa','lista_categorias'));
    }

}
