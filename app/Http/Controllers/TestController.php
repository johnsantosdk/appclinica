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
    public function __construct()
    {
        $this->middleware('auth');
    }
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

        // return response()->json(print_r($weekArrayOfObj));

        return response()->json(print_r($agendaf));
    }
}
