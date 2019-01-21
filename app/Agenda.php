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

    public static function filtraAgendaMedico($agenda)
    {

        //Array com os dias da semana em inglês pois o banco de dados lógico está em inglês
        $week = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday','friday', 'saturday');
        //Array de arrays que por sua vez guarda o nome do dia da semana e os horários
        $semana = array($domingo = ['Domingo'], $segunda = ['Segunda-feira'], $terça = ['Terça-feira'], $quarta = ['Quarta-feira'], $quinta = ['Quinta-feira'], $sexta = ['Sexta-feira'], $sábado = ['Sábado']);
              
        //Criação de uma stdClass para guardar as informações
        $agendaf = (object) [];
        //Criação de um atributo tipo array para inserir as informação pertinentes aos dias de atendimento
        $agendaf->dia = [];
        //Laço "for" para percorrer o object $agenda 
        for($i=0; $i < sizeof($week); $i++){     
            if($agenda->{$week[$i]} == 1){    
                if($agenda->{$week[$i].'_morning'} == 1){
                    //Inserção dos horários do turno matutino correspondente ao dia em questão
                    array_push($semana[$i], ' matutino das '.$agenda->{$week[$i].'_morning_start_time'}.' até as '.$agenda->{$week[$i].'_morning_end_time'});
                }if($agenda->{$week[$i].'_afternoon'} == 1){
                    //nserção dos horários do turno vespertino correspondente ao dia em questão
                    array_push($semana[$i], ' vespertino das '.$agenda->{$week[$i].'_afternoon_start_time'}.' até as '.$agenda->{$week[$i].'_afternoon_end_time'});
                }
                //Faz a inserção no laço se for verdaeira os parâmetros
                array_push($agendaf->dia, $semana[$i]);
            }
        }

        return $agendaf;
    }

    public static function getAgenda($agenda)
    {

        //Array com os dias da semana em inglês pois o banco de dados lógico está em inglês
        $week = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday','friday', 'saturday');
        //Array de arrays que por sua vez guarda o nome do dia da semana e os horários
        $semana = array($domingo    = (object) [
                            'name' => 'dom',
                        ],
                        $segunda    = (object) [
                            'name' => 'seg',
                        ], 
                        $terca      = (object) [
                            'name' => 'ter',
                        ], 
                        $quarta     = (object) [
                            'name' => 'qua',
                        ], 
                        $quinta     = (object) [
                            'name' => 'qui',
                        ], 
                        $sexta      = (object) [
                            'name' => 'sex',
                        ], 
                        $sábado     = (object) [
                            'name' => 'sab',
                        ]
        );
          
        //Criação de uma stdClass para guardar as informações
        $agendaf = (object) [];
        //Criação de um atributo tipo array para inserir as informação pertinentes aos dias de atendimento
        $agendaf->dia = [];
        //Laço "for" para percorrer o object $agenda 
        for($i=0; $i < sizeof($week); $i++){
              
            if($agenda->{$week[$i]} == 1){    
                if($agenda->{$week[$i].'_morning'} == 1){
                    //Inserção dos horários do turno matutino correspondente ao dia em questão
                    $semana[$i]->matutino   = 'matutino';
                    $semana[$i]->m_inicio     = $agenda->{$week[$i].'_morning_start_time'};
                    $semana[$i]->m_fim        = $agenda->{$week[$i].'_morning_end_time'};

                }if($agenda->{$week[$i].'_afternoon'} == 1){
                    //nserção dos horários do turno vespertino correspondente ao dia em questão
                    $semana[$i]->vespertino = 'vespertino';
                    $semana[$i]->v_inicio     = $agenda->{$week[$i].'_afternoon_start_time'};
                    $semana[$i]->v_fim        = $agenda->{$week[$i].'_afternoon_end_time'};
                }
                //Faz a inserção no laço se for verdaeira os parâmetros
                array_push($agendaf->dia, $semana[$i]);
            }
        }

        return $agendaf;
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
