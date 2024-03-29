<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public function categoria(){
        // linkando a foreign key
        return $this->belongsTo('App\Categoria','id_categoria');
    }
}
