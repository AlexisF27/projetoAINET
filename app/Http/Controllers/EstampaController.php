<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use App\Models\Categoria;
use Illuminate\Http\Request;

class EstampaController extends Controller
{
    //
    public function index(){
        $todasEstampas = Estampa::paginate(10);
        return view('estampas.index', compact('todasEstampas'));
    }
}
