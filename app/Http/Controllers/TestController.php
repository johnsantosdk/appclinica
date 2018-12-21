<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Paciente;
use Illuminate\Http\File;
use App\Especialidade;
use App\Medicoespecialidade;

class TestController extends Controller
{
    public function index()
    {

      $turno  = 2;
      $manha  = $turno == 1 ? 1 : 0;
      $tarde  = $turno == 2 ? 1 : 0;

      $data = '2018-12-28';
      $idmedico = 2;
      $idpaciente = 31;

              $paciente = DB::table('pacientes')
                            ->leftJoin('convenios', 'pacientes.idpaciente', '=', 'convenios.pacienteid')
                            ->leftJoin('planos',    'convenios.planoid',    '=', 'planos.idplano')
                            ->leftJoin('consultas', 'consultas.pacienteid', '=', 'pacientes.idpaciente')
                            ->leftJoin('medicos',   'consultas.medicoid',   '=', 'medicos.idmedico')
                            ->select('pacientes.idpaciente, pacientes.nome, pacientes.cpf, planos.nome as convenio')
                            ->where([
                                      ['consultas.data_consulta', '=', $data],
                                      ['consultas.tarde',         '=', 1],
                                      ['consultas.medicoid',      '=', $idmedico],
                                      ['consultas.pacienteid',    '=', $idpaciente],
                                    ])
                            ->get();

      
        return response()->json($paciente);

    
      
    }
}
