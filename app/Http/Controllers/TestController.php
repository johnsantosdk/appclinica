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
      $crm = '002461';

      $query  = "SELECT me.medicoid, me.especialidadeid, e.nome as 'especialidade'"; 
      $query .= " FROM medicos m";
      $query .= " LEFT JOIN medicoespecialidades me";
      $query .= " ON m.idmedico = me.medicoid";
      $query .= " LEFT JOIN especialidades e";
      $query .= " ON e.idespecialidade = me.especialidadeid";
      $query .= " WHERE m.crm = '$crm'";

      $medicos = DB::select(DB::raw($query));
/**
      $medicos = DB::select(DB::raw("SELECT idmedico, nome, crm FROM medicos"));

      $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
      **/
      foreach ($medicos as $medico ) {
            
      }




      return response()->json($medico->especialidade);
    }
}
