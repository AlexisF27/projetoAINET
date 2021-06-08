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
    public function store(Request $request){

    }

}
