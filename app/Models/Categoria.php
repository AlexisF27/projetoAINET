<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Categoria extends Model
{
    use HasFactory;


    public function estampas(){
        return $this->hasMany(Estampa::class,'categoria_id','id');
    }

}
