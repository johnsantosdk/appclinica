<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Paciente;
use App\Consulta;
use Illuminate\Http\File;
use App\Especialidade;
use App\Medicoespecialidade;
use App\Agenda;

class TestController extends Controller
{
    public function index()
    {
        $str = 'first_name';

        $obj = (object) [
          'first_name' => 'Nani',
          'last_name' => 'Mcbee',
        ];
        $colunm = 'paciente';
        $paciente = DB::select(DB::raw("SELECT id{$colunm} FROM pacientes WHERE idpaciente = 31"));

        $result = Agenda::getAgendaTest('2018-12-28', 2, 2);

        // return response()->json($obj->{'first_'.$str});  
        // return response()->json($obj->{$str});
        // return response()->json($paciente);
    }
}
