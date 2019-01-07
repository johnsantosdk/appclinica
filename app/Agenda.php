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

    public static function getFiltroAgenda($date, $turno, $medicoid)
    {
    	//pega o nome do dia da semana para realizar o filtro
		$nameOfDay = strtolower(date('l', strtotime($date)));
		//
        $results = DB::select(DB::raw("SELECT {$nameOfDay},
                  							  {$nameOfDay}_morning, 
                  							  {$nameOfDay}_morning_start_time, 
                  							  {$nameOfDay}_morning_end_time,  
                  							  {$nameOfDay}_afternoon,
                  							  {$nameOfDay}_afternoon_start_time, 
                  							  {$nameOfDay}_afternoon_end_time
                  					   FROM agendas 
                  					   WHERE medicoid = '$medicoid'"));
        return $results;
    }

    public static function getAgendaMedico($medicoid, $especialidadeid)
    {
        if(isset($medicoid, $especialidadeid)){

            $agendas = DB::select(DB::raw("SELECT
                                                 sunday,
                                                 sunday_morning,
                                                 sunday_morning_start_time,
                                                 sunday_morning_end_time,
                                                 sunday_afternoon,
                                                 sunday_afternoon_start_time,
                                                 sunday_afternoon_end_time,
                                                 monday,
                                                 monday_morning,
                                                 monday_morning_start_time,
                                                 monday_morning_end_time,
                                                 monday_afternoon,
                                                 monday_afternoon_start_time,
                                                 monday_afternoon_end_time,
                                                 tuesday,
                                                 tuesday_morning,
                                                 tuesday_morning_start_time,
                                                 tuesday_morning_end_time,
                                                 tuesday_afternoon,
                                                 tuesday_afternoon_start_time,
                                                 tuesday_afternoon_end_time,
                                                 wednesday,
                                                 wednesday_morning,
                                                 wednesday_morning_start_time,
                                                 wednesday_morning_end_time,
                                                 wednesday_afternoon,
                                                 wednesday_afternoon_start_time,
                                                 wednesday_afternoon_end_time,
                                                 thursday,
                                                 thursday_morning,
                                                 thursday_morning_start_time,
                                                 thursday_morning_end_time,
                                                 thursday_afternoon,
                                                 thursday_afternoon_start_time,
                                                 thursday_afternoon_end_time,
                                                 friday,
                                                 friday_morning,
                                                 friday_morning_start_time,
                                                 friday_morning_end_time,
                                                 friday_afternoon,
                                                 friday_afternoon_start_time,
                                                 friday_afternoon_end_time,
                                                 saturday,
                                                 saturday_morning,
                                                 saturday_morning_start_time,
                                                 saturday_morning_end_time,
                                                 saturday_afternoon,
                                                 saturday_afternoon_start_time,
                                                 saturday_afternoon_end_time
                                            FROM agendas 
                                            WHERE medicoid = '$medicoid' &&
                                                  especialidadeid = '$especialidadeid'"));
            foreach($agendas as $agenda){}
            if(isset($agenda)){

                return $agenda;

            }else{

                return 0;

            }    
        }else{

            return 0;

        }
    }
}
