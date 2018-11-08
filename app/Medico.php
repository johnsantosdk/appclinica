<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Consulta;
use App\Especialidade;


class Medico extends Model
{
    //
	//Um médico pode ter várias consultas marcadas para ele
    public function consulta() {

    	return $this->hasMany('App\Consulta', 'medicoid');
    }
    //Um médico pode ter várias especialidades
    public function especialidade() {

    	return $this->hasMany('App\Especialidade');
    }
}
