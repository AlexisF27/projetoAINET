<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use Illuminate\Http\Request;

class TshirtController extends Controller
{
    public function index(){
        $todasTshirts = Tshirt::paginate(10);
        return view('tshirt.index', compact('todasTshirts'));
    }
}
