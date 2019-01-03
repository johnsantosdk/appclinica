<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Agenda extends Model
{
    protected $fillable = [
    	 'idagenda',
    	 'sunday',
    	 'sunday_morning',
		 'sunday_morning_start_time',
		 'sunday_morning_end_time',
		 'sunday_afternoon',
		 'sunday_afternoon_start_time',
		 'sunday_afternoon_end_time',
		 'monday',
		 'monday_morning',
		 'monday_morning_start_time',
		 'monday_morning_end_time',
		 'monday_afternoon',
		 'monday_afternoon_start_time',
		 'monday_afternoon_end_time',
		 'tuesday',
		 'tuesday_morning',
		 'tuesday_morning_start_time',
		 'tuesday_morning_end_time',
		 'tuesday_afternoon',
		 'tuesday_afternoon_start_time',
		 'tuesday_afternoon_end_time',
		 'wednesday',
		 'wednesday_morning',
		 'wednesday_morning_start_tim',
		 'wednesday_morning_end_time',
		 'wednesday_afternoon',
		 'wednesday_afternoon_start_tim',
		 'wednesday_afternoon_end_time',
		 'thursday',
		 'thursday_morning',
		 'thursday_morning_start_time',
		 'thursday_morning_end_time',
		 'thursday_afternoon',
		 'thursday_afternoon_start_time',
		 'thursday_afternoon_end_time',
		 'friday',
		 'friday_morning',
		 'friday_morning_start_time',
		 'friday_morning_end_time',
		 'friday_afternoon',
		 'friday_afternoon_start_time',
		 'friday_afternoon_end_time',
		 'saturday',
		 'saturday_morning',
		 'saturday_morning_start_time',
		 'saturday_morning_end_time',
		 'saturday_afternoon',
		 'saturday_afternoon_start_time',
		 'saturday_afternoon_end_time',
		 'current',
		 'medicoid',
		 'especialidadeid',
    ];

    protected $primaryKey = 'idagenda';

    public function medico(){
    	return $this->belongsTo('App\Medico');
    }

    public static function getAgendaTest($date, $turno, $medicoid)
    {
    	//pega o nome do dia da semana para realizar o filtro
		$nameOfDay = strtolower(date('l', strtotime($date)));
		//Swicth para cada dia da semana
        $results = DB::select(DB::raw("SELECT {$nameOfDay},
                  							  {$nameOfDay}_morning, 
                  							  {$nameOfDay}_morning_start_time, 
                  							  {$nameOfDay}_morning_end_time,  
                  							  {$nameOfDay}_afternoon,
                  							  {$nameOfDay}_afternoon_start_time, 
                  							  {$nameOfDay}_afternoon_end_time,
                  						FROM agendas 
                  						WHERE medicoid = '$medicoid'"));
        if(isset($results)){
            foreach($results as $result){}
        }
        if(isset($result)){
        //Se o $result não estiver vazio será criado um obj para armazenar o resulta da query
            $obj = (object) [
                'date' 				=> $date,
                'nameOfDay' 		=> $nameOfDay,
                'boolean' 			=> $result->{$nameOfDay},
                'morning' 			=> $result->{$nameOfDay.'_morning'},
                'morningStart' 		=> $result->{$nameOfDay.'_morning_start_time'},
                'morningEnd' 		=> $result->{$nameOfDay.'_morning_end_time'},
                'afternoon' 		=> $result->{$nameOfDay.'_afternoon'},
                'afternoonStart' 	=> $result->{$nameOfDay.'_afternoon_start_time'},
                'afternoonEnd' 		=> $result->{$nameOfDay.'_afternoon_end_time'},
            ];

        if($result->{$nameOfDay} == 1){
            if($turno == 1){
            //     //select da parte da manhã
            //     $consultas = DB::select(DB::raw("SELECT p.idpaciente,
            //                     						p.nome,
            //                     						p.cpf,
            //                     						pl.nome as 'convenio'
            //                                      FROM pacientes p
            //                                      LEFT JOIN convenios cv
            //                                      ON cv.pacienteid = p.idpaciente
            //                                      LEFT JOIN  planos pl
            //                                      ON cv.planoid = pl.idplano
            //                                      LEFT JOIN  consultas cs
            //                                      ON cs.pacienteid = p.idpaciente
            //                                      LEFT JOIN  medicos m
            //                                      ON cs.medicoid = m.idmedico
            //                                      WHERE cs.data_consulta = '$date' &&
            //                                       	   cs.manha = 1 && 
            //                                       	   cs.medicoid = '$medicoid'
            //                                     "));

            //     return response()->json(array(
            //         'object' => $obj,
            //         'consultas' => $consultas,
            //     ));

            // }if($turno == 2){
            //     //select da parte da tarde
            //     $consultas = DB::select(DB::raw("SELECT p.idpaciente,
            //      										p.nome, 
            //      										p.cpf, 
            //      										pl.nome as 'convenio'
            //                                      FROM pacientes p
            //                                      LEFT JOIN convenios cv
            //                                      ON cv.pacienteid = p.idpaciente
            //                                      LEFT JOIN  planos pl
            //                                      ON cv.planoid = pl.idplano
            //                                      LEFT JOIN  consultas cs
            //                                      ON cs.pacienteid = p.idpaciente
            //                                      LEFT JOIN  medicos m
            //                                      ON cs.medicoid = m.idmedico
            //                                      WHERE cs.data_consulta = '$date' &&
            //                                            cs.tarde = 1 && 
            //                                            cs.medicoid = '$medicoid'
            //                                     "));

                $consultas = Consulta::getConsultaMedico($date, $turno, $medicoid);

                return response()->json(array(
                    'object' => $obj,
                    'consultas' => $consultas,
                ));

            }
            }if($result->{$nameOfDay} == 0){
                //Não atende neste dia então retorna um obj com os detalhes
                return response()->json(array(
                    'object' => $obj,
                ));
            }                        
        }
        //Não encontrado
        return response()->json('404');
    }
}
