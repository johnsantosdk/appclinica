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
//       $crm = '002461';

//       $query  = "SELECT me.medicoid, me.especialidadeid, e.nome as 'especialidade'"; 
//       $query .= " FROM medicos m";
//       $query .= " LEFT JOIN medicoespecialidades me";
//       $query .= " ON m.idmedico = me.medicoid";
//       $query .= " LEFT JOIN especialidades e";
//       $query .= " ON e.idespecialidade = me.especialidadeid";
//       $query .= " WHERE m.crm = '$crm'";

//       $medicos = DB::select(DB::raw($query));
// /**
//       $medicos = DB::select(DB::raw("SELECT idmedico, nome, crm FROM medicos"));

//       $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
//       **/
//       foreach ($medicos as $medico ) {
            
//       }

//       $obj1 = (object) [
//         'firstName' => 'John',
//         'lastName'  => 'Santos',
//       ];

//       $obj2 = (object) [
//         'phone1'  => '(98)98888-5555',
//         'phone2'  => '(98)98888-7777',
//       ];

      // $objMerged = (object) array_merge((array) $obj1, (array) $obj2);

      // $medEsp = Medicoespecialidade::find([1,51]);

    //   return response()->json(array(
    //     'objeto1' => $obj1,
    //     'objeto2' => $obj2,
    //   ));
    //
      $turno  = 2;
      $manha  = $turno == 1 ? 1 : 0;
      $tarde  = $turno == 2 ? 1 : 0;

      $data = '2018-12-21';
      $idmedico = 2;
      $idpaciente = 31;

      // return response()->json(isset($idpaciente, $idmedico, $data) && $tarde == 1);

      if(isset($idpaciente, $idmedico, $data) && $manha == 1){

                $pacientes = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                 FROM pacientes p
                                                 LEFT JOIN convenios cv
                                                 ON cv.pacienteid = p.idpaciente
                                                 LEFT JOIN  planos pl
                                                 ON cv.planoid = pl.idplano
                                                 LEFT JOIN  consultas cs
                                                 ON cs.pacienteid = p.idpaciente
                                                 LEFT JOIN  medicos m
                                                 ON cs.medicoid = m.idmedico
                                                 WHERE cs.data_consulta = '$data' && cs.manha = 1 && cs.medicoid = '$idmedico' && cs.pacienteid = '$idpaciente'
                                                "));
        return response()->json($pacientes);

    }if(isset($idpaciente, $idmedico, $data) && $tarde == 1){

                $pacientes = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                 FROM pacientes p
                                                 LEFT JOIN convenios cv
                                                 ON cv.pacienteid = p.idpaciente
                                                 LEFT JOIN  planos pl
                                                 ON cv.planoid = pl.idplano
                                                 LEFT JOIN  consultas cs
                                                 ON cs.pacienteid = p.idpaciente
                                                 LEFT JOIN  medicos m
                                                 ON cs.medicoid = m.idmedico
                                                 WHERE cs.data_consulta = '$data' && cs.tarde = 1 && cs.medicoid = '$idmedico' && cs.pacienteid = '$idpaciente'
                                                "));
                foreach ($pacientes as $paciente ) {
                  # code...
                }
        return response()->json($paciente);

    }
      
    }
}
