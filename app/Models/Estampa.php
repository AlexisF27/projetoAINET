<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Estampa extends Model
{
    use HasFactory;

    public function categoriaRef(){
        return $this->belongsTo(Categoria::class);
    }

    public function tshirts(){
        return $this->hasMany(Tshirt::class);
    }

    public function clienteRef(){
        return $this->belongsTo(Cliente::class);
    }


}
