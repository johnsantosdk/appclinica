<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Paciente;

class TestController extends Controller
{
    public function index()
    {/**
        $pacientes = DB::table('pacientes')
                       ->leftJoin('telefones', 'pacientes.idpaciente', '=', 'telefones.pacienteid')
                       ->leftJoin('convenios', 'pacientes.idpaciente', '=', 'convenios.pacienteid')
                       ->leftJoin('planos', 'planos.idplano', '=', 'convenios.planoid')
                       ->select('pacientes.nome, planos.nome, convenios.matricula, telefones.numero')
                       ->get();

        return response()->json($pacientes);**/
    }
}
