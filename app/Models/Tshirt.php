<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id','encomenda_id','estampa_id','cor_codigo','tamanho','quantidade','preco_un','subtotal'];


    public function estampaRef(){
        return $this->belongsTo(Estampa::class,'estampa_id','id');
    }

    public function encomendasRef(){
        return $this->belongsTo(Encomenda::class,'encomenda_id','id');
    }

    public function coresRef(){
        return $this->belongsTo(Cores::class,'cor_codigo','codigo');
    }

}
