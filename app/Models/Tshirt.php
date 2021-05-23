<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;


    public function estampaRef(){
        return $this->belongsTo(Estampa::class,'estampa_id','id');
    }

    public function encomendasRef(){
        return $this->belongsTo(Encomenda::class,'encomenda_id','id');
    }

    public function coresRef(){
        return $this->belongsTo(Cor::class,'cor_codigo','codigo');
    }

}
