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

      $obj1 = (object) [
        'firstName' => 'John',
        'lastName'  => 'Santos',
      ];

      $obj2 = (object) [
        'phone1'  => '(98)98888-5555',
        'phone2'  => '(98)98888-7777',
      ];

      // $objMerged = (object) array_merge((array) $obj1, (array) $obj2);

      // $medEsp = Medicoespecialidade::find([1,51]);

      return response()->json(array(
        'objeto1' => $obj1,
        'objeto2' => $obj2,
      ));
    }
}
