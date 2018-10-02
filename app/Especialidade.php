<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    //

    public function medico() {

    	return $this->belongsToMany('App\Medico');
    }
}
