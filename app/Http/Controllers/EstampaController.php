<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use Illuminate\Http\Request;

class EstampaController extends Controller
{
    //
    public function index(){
        $todasEstampas = Estampa::all();
        return view('estampas.index', compact('todasEstampas'));
    }
}
