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

    public static function getConsultaMedico($date, $turno, $medicoid)
    {
        // $consultas = DB::table('consultas')
           //                ->leftJoin('pacientes', 'pacientes.idpaciente', '=', 'consultas.pacienteid')
           //                ->leftJoin('convenios', 'convenios.pacienteid', '=', 'pacientes.idpaciente')
           //                ->leftJoin('planos',    'planos.idplano',       '=', 'convenios.planoid')
           //                ->leftJoin('medicos',   'medicos.idmedico',     '=', 'consultas.medicoid')
           //                ->select('pacientes.idpaciente,
           //                          pacientes.nome,
           //                          pacientes.cpf,
           //                          planos.nome as convenio
           //                         ')
           //                ->where([
           //                      ['consultas.data_consulta', '=', $date],
           //                      ['consultas.{$turno}',      '=', 1],
           //                      ['consultas.medicoid',      '=', $medicoid],
           //                        ])
        //                ->get();

            $consultas = DB::select(DB::raw("SELECT p.idpaciente,
                                                        p.nome,
                                                        p.cpf,
                                                        pl.nome as 'convenio'
                                             FROM pacientes p
                                             LEFT JOIN convenios cv
                                             ON cv.pacienteid = p.idpaciente
                                             LEFT JOIN  planos pl
                                             ON cv.planoid = pl.idplano
                                             LEFT JOIN  consultas cs
                                             ON cs.pacienteid = p.idpaciente
                                             LEFT JOIN  medicos m
                                             ON cs.medicoid = m.idmedico
                                             WHERE cs.data_consulta = '$date' &&
                                                   cs.{$turno} = 1 && 
                                                   cs.medicoid = '$medicoid'
                                            "));

            return $consultas;
    }

}
