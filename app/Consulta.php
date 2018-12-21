<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consulta extends Model
{
    //

    protected $fillable = [
        'idconsulta',
        'data_consulta',
        'horario',
        'manha',
        'tarde',
        'pacienteid',
        'medicoid',
    ];

     protected $primaryKey = 'idconsulta';

    public function paciente() {

    	return $this->belongsTo('App\Paciente');
    }

    public function atendente() {

    	return $this->belongsTo('App\Atendente');
    }

    public function convenio() {

    	return $this->belongsto('App\Convenio');
    }

    public function medico() {

    	return $this->belongsTo('App\Medico');
    }

// public static function getConsultas($idmedico, $data, $nameOfday)
    // {
    //     switch ($nameOfDay) {
    //                     case 'sunday':
    //                       $boolean = DB::select(DB::raw("SELECT sunday, sunday_start_time, sunday_end_time, sunday_morning, sunday_afternoon FROM agendas WHERE medicoid = '$idmedico'"));
    //                       if(isset($boolean)){}
    //                       foreach($boolean as $bool){}
    //                         if(isset($bool)){

    //                             $obj = (object) [
    //                                 'date' => $data,
    //                                 'nameOfDay' => $nameOfDay,
    //                                 'boolean' => $bool->sunday,
    //                                 'morning' => $bool->sunday_morning,
    //                                 'afternoon' => $bool->sunday_afternoon,
    //                                 'start' => $bool->sunday_start_time,
    //                                 'end' => $bool->sunday_end_time,
    //                             ];

    //                             if($bool->sunday == 1){
    //                                 if($request->turno == 1){
    //                                     //select da parte da manhã
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.manha = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));

    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));

    //                                 }if($request->turno == 2){
    //                                     //select da parte da tarde
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.tarde = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));

    //                                 }
    //                             }if($bool->sunday == 0){
    //                                 //Não atende neste dia
    //                             }

    //                             return response()->json(array(
    //                                 'object' => $obj,
    //                             ));                        
    //                         }

    //                         // if($bool->sunday == 1 && $time >= $start && $time <= $end )
    //                             return response()->json('404');
    //                       break;
    //                     case 'monday':
    //                       $boolean = DB::select(DB::raw("SELECT monday, monday_start_time, monday_end_time, monday_morning, monday_afternoon FROM agendas WHERE medicoid = '$idmedico'"));
    //                       foreach($boolean as $bool){}
    //                         if(isset($bool)){

    //                             $obj = (object) [
    //                                 'date' => $data,
    //                                 'nameOfDay' => $nameOfDay,
    //                                 'boolean' => $bool->monday,
    //                                 'morning' => $bool->monday_morning,
    //                                 'afternoon' => $bool->monday_afternoon,
    //                                 'start' => $bool->monday_start_time,
    //                                 'end' => $bool->monday_end_time,
    //                             ];

    //                             if($bool->monday == 1){
    //                                 if($request->turno == 1){
    //                                     //select da parte da manhã
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.manha = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));

    //                                 }if($request->turno == 2){
    //                                     //select da parte da tarde
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.tarde = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));
    //                                 }
    //                             }if($bool->monday == 0){
    //                                 //Não atende neste dia
    //                             }

    //                             return response()->json(array(
    //                                 'object' => $obj,
    //                             ));

    //                         }
    //                             return response()->json('404');

    //                       break;

    //                     case 'tuesday':
    //                       $boolean = DB::select(DB::raw("SELECT tuesday, tuesday_start_time, tuesday_end_time, tuesday_morning, tuesday_afternoon FROM agendas WHERE medicoid = '$idmedico'"));
    //                       foreach($boolean as $bool){}
    //                         if(isset($bool)){

    //                             $obj = (object) [
    //                                 'date' => $data,
    //                                 'nameOfDay' => $nameOfDay,
    //                                 'boolean' => $bool->tuesday,
    //                                 'morning' => $bool->tuesday_morning,
    //                                 'afternoon' => $bool->tuesday_afternoon,
    //                                 'start' => $bool->tuesday_start_time,
    //                                 'end' => $bool->tuesday_end_time,
    //                             ];

    //                             if($bool->tuesday == 1){
    //                                 if($request->turno == 1){
    //                                     //select da parte da manhã
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.manha = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));

    //                                 }if($request->turno == 2){
    //                                     //select da parte da tarde
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.tarde = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));
    //                                 }
    //                             }if($bool->tuesday == 0){
    //                                 //Não atende neste dia
    //                             }

    //                             return response()->json(array(
    //                                 'object' => $obj,
    //                             ));

    //                         }
    //                             return response()->json('404');

    //                       break;

    //                     case 'wednesday':
    //                       $boolean = DB::select(DB::raw("SELECT wednesday, wednesday_start_time, wednesday_end_time, wednesday_morning, wednesday_afternoon FROM agendas WHERE medicoid = '$idmedico'"));
    //                       foreach($boolean as $bool){}
    //                         if(isset($bool)){

    //                             $obj = (object) [
    //                                 'date' => $data,
    //                                 'nameOfDay' => $nameOfDay,
    //                                 'boolean' => $bool->wednesday,
    //                                 'morning' => $bool->wednesday_morning,
    //                                 'afternoon' => $bool->wednesday_afternoon,
    //                                 'start' => $bool->wednesday_start_time,
    //                                 'end' => $bool->wednesday_end_time,
    //                             ];

    //                             if($bool->wednesday == 1){
    //                                 if($request->turno == 1){
    //                                     //select da parte da manhã
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.manha = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));

    //                                 }if($request->turno == 2){
    //                                     //select da parte da tarde
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.tarde = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));

    //                                 }
    //                             }if($bool->wednesday == 0){
    //                                 //Não atende neste dia
    //                             }

    //                             return response()->json(array(
    //                                 'object' => $obj,
    //                             ));

    //                         }
    //                             return response()->json('404');

    //                       break;

    //                     case 'thursday':
    //                       $boolean = DB::select(DB::raw("SELECT thursday, thursday_start_time, thursday_end_time, thursday_morning, thursday_afternoon FROM agendas WHERE medicoid = '$idmedico'"));
    //                       foreach($boolean as $bool){}
    //                         if(isset($bool)){

    //                             $obj = (object) [
    //                                 'date' => $data,
    //                                 'nameOfDay' => $nameOfDay,
    //                                 'boolean' => $bool->thursday,
    //                                 'morning' => $bool->thursday_morning,
    //                                 'afternoon' => $bool->thursday_afternoon,
    //                                 'start' => $bool->thursday_start_time,
    //                                 'end' => $bool->thursday_end_time,
    //                             ];

    //                             if($bool->thursday == 1){
    //                                 if($request->turno == 1){
    //                                     //select da parte da manhã
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.manha = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));
    //                                 }if($request->turno == 2){
    //                                     //select da parte da tarde
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.tarde = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));
    //                                 }
    //                             }if($bool->thursday == 0){
    //                                 //Não atende neste dia
    //                             }

    //                             return response()->json(array(
    //                                 'object' => $obj,
    //                             ));

    //                         }
    //                             return response()->json('404');
    //                       break;

    //                     case 'friday':
    //                       $boolean = DB::select(DB::raw("SELECT friday, friday_start_time, friday_end_time, friday_morning, friday_afternoon FROM agendas WHERE medicoid = '$idmedico'"));
    //                       foreach($boolean as $bool){}
    //                         if(isset($bool)){

    //                             $obj = (object) [
    //                                 'date' => $data,
    //                                 'nameOfDay' => $nameOfDay,
    //                                 'boolean' => $bool->friday,
    //                                 'morning' => $bool->friday_morning,
    //                                 'afternoon' => $bool->friday_afternoon,
    //                                 'start' => $bool->friday_start_time,
    //                                 'end' => $bool->friday_end_time,
    //                             ];

    //                             if($bool->friday == 1){
    //                                 if($request->turno == 1){
    //                                     //select da parte da manhã
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.manha = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));

    //                                 }if($request->turno == 2){
    //                                     //select da parte da tarde
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.tarde = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));
    //                                 }
    //                             }if($bool->friday == 0){
    //                                 //Não atende neste dia
    //                             }

    //                             return response()->json(array(
    //                                 'object' => $obj,
    //                             ));
                                
    //                         }
    //                             return response()->json('404');

    //                       break;

    //                     case 'saturday':
    //                       $boolean = DB::select(DB::raw("SELECT saturday, saturday_start_time, saturday_end_time, saturday_morning, saturday_afternoon  FROM agendas WHERE medicoid = '$idmedico'"));
    //                       foreach($boolean as $bool){}
    //                         if(isset($bool)){

    //                             $obj = (object) [
    //                                 'date' => $data,
    //                                 'nameOfDay' => $nameOfDay,
    //                                 'boolean' => $bool->saturday,
    //                                 'morning' => $bool->saturday_morning,
    //                                 'afternoon' => $bool->saturday_afternoon,
    //                                 'start' => $bool->saturday_start_time,
    //                                 'end' => $bool->saturday_end_time,
    //                             ];

    //                             if($bool->saturday == 1){
    //                                 if($request->turno == 1){
    //                                     //select da parte da manhã
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.manha = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));

    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));

    //                                 }if($request->turno == 2){
    //                                     //select da parte da tarde
    //                                     $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
    //                                                                      FROM pacientes p
    //                                                                      LEFT JOIN convenios cv
    //                                                                      ON cv.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  planos pl
    //                                                                      ON cv.planoid = pl.idplano
    //                                                                      LEFT JOIN  consultas cs
    //                                                                      ON cs.pacienteid = p.idpaciente
    //                                                                      LEFT JOIN  medicos m
    //                                                                      ON cs.medicoid = m.idmedico
    //                                                                      WHERE cs.data_consulta = '$data' && cs.tarde = 1 && cs.medicoid = '$idmedico'
    //                                                                     "));
    //                                     return response()->json(array(
    //                                         'object' => $obj,
    //                                         'consultas' => $consultas,
    //                                     ));
    //                                 }
    //                             }if($bool->saturday == 0){
    //                                 //Não atende neste dia
    //                             }

    //                             return response()->json(array(
    //                                 'object' => $obj,
    //                             ));                       
    //                         }
    //                             return response()->json('404');

    //                       break;

    //                     default:

    //                         $obj = (object) [
    //                             'day' => $nameOfDay,
    //                             'boolean' => '404',
    //                         ];

    //                       break;
    //     }        
// }

    public static function getPaciente($data, $idmedico, $idpaciente)
    {
        // $paciente = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
        //                                 FROM pacientes p
        //                                 LEFT JOIN convenios cv
        //                                 ON cv.pacienteid = p.idpaciente
        //                                 LEFT JOIN  planos pl
        //                                 ON cv.planoid = pl.idplano
        //                                 LEFT JOIN  consultas cs
        //                                 ON cs.pacienteid = p.idpaciente
        //                                 LEFT JOIN  medicos m
        //                                 ON cs.medicoid = m.idmedico
        //                                 WHERE cs.data_consulta = '$data' && cs.tarde = 1 && cs.medicoid = '$idmedico' && cs.pacienteid = '$idpaciente'");
        
        $paciente = DB::table('pacientes')
                      ->leftJoin('convenios', 'pacientes.idpaciente', '=', 'convenios.pacienteid')
                      ->leftJoin('planos', 'convenios.planoid', '=', 'planos.idplano')
                      ->leftJoin('consultas', 'consultas.pacienteid', '=', 'pacientes.idpaciente')
                      ->leftJoin('medicos', 'consultas.medicoid', '=', 'medicos.idmedico')
                      ->select('pacientes.idpaciente, pacientes.nome, pacientes.cpf, planos.nome as convenio')
                      ->where(['consultas.data_consulta', '=', $data],
                              ['consultas.tarde', '=', 1],
                              ['consultas.medicoid', '=', $idmedico],
                              ['consultas.pacienteid', '=', $idpaciente]
                              );
        
        // $paciente = (object) [
        //   'nome'  => 'inexistente',
        //   'error' => 'not found 404',
        // ];

        return $paciente;
    }
}
