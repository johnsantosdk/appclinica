<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atendente extends Model
{
    //

    public function consulta() {


    	return $this->hasMany('App\Consultas');
    }
}
