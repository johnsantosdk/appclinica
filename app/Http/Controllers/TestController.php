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
        // $consultas = Consulta::getConsultaMedico('2018-12-28', 'tarde', 2);
        // $cs = Agenda::getAgenda('2018-12-28', 'tarde', 2);

        $nameOfDay = 'wednesday';
        $medicoid  = 2;
                $results = DB::select(DB::raw("SELECT {$nameOfDay},
                  							  {$nameOfDay}_morning, 
                  							  {$nameOfDay}_morning_start_time, 
                  							  {$nameOfDay}_morning_end_time,  
                  							  {$nameOfDay}_afternoon,
                  							  {$nameOfDay}_afternoon_start_time, 
                  							  {$nameOfDay}_afternoon_end_time
                  						FROM agendas 
                  						WHERE medicoid = '$medicoid'"));

        return response()->json($results);
    }
}
