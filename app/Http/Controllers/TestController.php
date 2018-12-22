<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Paciente;
use App\Consulta;
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

      $str = 'tarde';
      $data = '2018-12-28';
      $idmedico = 2;
      $idpaciente = 31;

              $paciente = DB::table('consultas')
                            ->select('idconsulta')
                            ->where([
                                      ['data_consulta', '=', $data],
                                      [$str,            '=', 1],
                                      ['medicoid',      '=', $idmedico],
                                      ['pacienteid',    '=', $idpaciente],
                                    ])
                            ->first();

        $id = Consulta::getConsultaId($idmedico, $idpaciente, $data, 'tarde', 1);


        return response()->json($id);  
    }
}
