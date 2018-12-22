<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consulta extends Model
{
    //

    protected $fillable = [
        'idconsulta',
        'data_consulta',
        'horario',
        'manha',
        'tarde',
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

    public static function getConsultaId($idmedico, $idpaciente, $data, $turnoString, $turnoValue)
    {
        $result = DB::table('consultas')
          ->select('idconsulta')
          ->where([
                  ['data_consulta', '=', $data],
                  [$turnoString,    '=', $turnoValue],
                  ['medicoid',      '=', $idmedico],
                  ['pacienteid',    '=', $idpaciente],
                  ])
          ->first();

        return $result;
    }
}
