<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Estampa extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['categoria_id','nome','descricao','imagem_url','informacao_extra'];


    public function categoriaRef(){
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public function tshirts(){
        return $this->hasMany(Tshirt::class);
    }

    public function clienteRef(){
        return $this->belongsTo(Cliente::class);
    }


}
