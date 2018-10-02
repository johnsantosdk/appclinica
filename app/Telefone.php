<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paciente;

class Telefone extends Model
{
    //

    public function paciente() {

    	return $this->belongsTo('App\Paciente');
    }
}
