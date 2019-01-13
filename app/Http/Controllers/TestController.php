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
      /**
      *1 - Fazer um select sem a necessidade de informar todos os campos de vez só
      *2 - Retornar só as colunas que valor 1
      *3 - Como fazer isso?
      *
      **/
    $agenda = Agenda::getAgendaMedico(2,84);
    //Array com os dias da semana em inglês pois o banco de dados lógico está em inglês
    $week = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday','friday', 'saturday');
    //Array de arrays que por sua vez guarda o nome do dia da semana e os horários
    $semana = array($domingo = ['domingo'], $segunda = ['segunda'], $terça = ['terça'], $quarta = ['quarta'], $quinta = ['quinta'], $sexta = ['sexta'], $sábado = ['sábado']);
      
    //Criação de uma stdClass para guardar as informações
    $agendaf = (object) [];
    //Criação de um atributo tipo array para inserir as informação pertinentes aos dias de atendimento
    $agendaf->dia = [];
    //Laço "for" para percorrer o object $agenda 
    for($i=0; $i < sizeof($week); $i++){
          
        if($agenda->{$week[$i]} == 1){    
            if($agenda->{$week[$i].'_morning'} == 1){
                //Inserção dos horários do turno matutino correspondente ao dia em questão
                array_push($semana[$i], ['matutino' => [$agenda->{$week[$i].'_morning_start_time'},
                                                        $agenda->{$week[$i].'_morning_end_time'}
                                                       ]
                                        ]
                           );
            }if($agenda->{$week[$i].'_afternoon'} == 1){
                //nserção dos horários do turno vespertino correspondente ao dia em questão
                array_push($semana[$i], ['vespertino' => [$agenda->{$week[$i].'_afternoon_start_time'},
                                                          $agenda->{$week[$i].'_afternoon_end_time'}
                                                         ]
                                        ]
                           );
            }
            //Faz a inserção no laço se for verdaeira os parâmetros
            array_push($agendaf->dia, $semana[$i]);
        }
    }

        return response()->json(print_r($agendaf));
    }
}
