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
        $consultas = Consulta::getConsultaMedico('2018-12-28', 'tarde', 2);
        $cs = Agenda::getAgendaTest('2018-12-28', 'tarde', 2);
        return response()->json($consultas);
    }
}
