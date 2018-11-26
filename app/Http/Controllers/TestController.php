<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Paciente;
use Illuminate\Http\File;
use App\Especialidade;

class TestController extends Controller
{
    public function index()
    {

      $esps = DB::select(DB::raw("SELECT me.medicoid, me.especialidadeid, e.nome as 'especialidade' 
                                                       FROM medicos m 
                                                       LEFT JOIN medicoespecialidades me 
                                                       ON m.idmedico = me.medicoid 
                                                       LEFT JOIN especialidades e 
                                                       ON e.idespecialidade = me.especialidadeid
                                                     "));

      $medicos = DB::select(DB::raw("SELECT idmedico, nome, crm FROM medicos"));

      $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
      
      foreach ($esps as $esp ) {
            
      }




      return response()->json($esp);
    }
}
