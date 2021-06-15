<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'id','id');
    }

    public function encomendas(){
        return $this->hasMany(Encomenda::class);
    }
    public function estampas(){
        return $this->hasMany(Estampa::class);
    }

}


