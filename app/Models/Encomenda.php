<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda  extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id','estado','cliente_id','data','preco_total','notas','nif','endereco','tipo_pagamento','ref_pagamento','recibo_url'];


    public function tshirts(){
        return $this->hasMany(Tshirt::class,'encomenda_id','id');
    }

    public function clienteRef(){
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }

}
