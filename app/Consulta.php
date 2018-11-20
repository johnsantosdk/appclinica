<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    //

    protected $fillable [
        'idconsulta',
        'data_consulta',
        'horario',
        'pacienteid',
        'medicoid',
    ];

     protected $primaryKey = 'idconsulta';

    public function paciente() {

    	return $this->belongsTo('App\Paciente');
    }

    public function atendente() {

    	return $this->belongsTo('App\Atendente');
    }

    public function convenio() {

    	return $this->belongsto('App\Convenio');
    }

    public function medico() {

    	return $this->belongsTo('App\Medico');
    }
}
