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

      $week = array('sunday',
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                    );
      $agenda = Agenda::getAgendaMedico(2,84);

      $agendafiltrada = array();

      // for($i=0; $i <= sizeof($week); $i++){
          
      //     if($agenda->{$week[$i]} == 1){
      //        array_push($agendafiltrada, '{$week[$i]}'                      => $agenda->{$week[$i]},
      //                                    '{$week[$i]}_morning'              => $agenda->{$week[$i].'_morning'},
      //                                    '{$week[$i]}_morning_start_time'   => $agenda->{$week[$i].'_morning_start_time'},
      //                                    '{$week[$i]}_morning_end_time'     => $agenda->{$week[$i].'_morning_end_time'},
      //                                    '{$week[$i]}_afternoon'            => $agenda->{$week[$i].'_afternoon'},
      //                                    '{$week[$i]}_afternoon_start_time' => $agenda->{$week[$i].'_afternoon_start_time'},
      //                                    '{$week[$i]}_afternoon_end_time'   => $agenda->{$week[$i].'_afternoon_end_time'},
      //                   );
      //     }
      // }
      $agendaF = (object) [];

      for($i=0; $i < sizeof($week); $i++){
          
          if($agenda->{$week[$i]} == 1){
                //Adiciona o dia da semana que seja = 1
                $agendaF->{$week[$i]} = $agenda->{$week[$i]};

            if($agenda->{$week[$i].'_morning'} == 1){
                //Add como atributos os horários
                $agendaF->{$week[$i].'_morning'}                = $agenda->{$week[$i].'_morning'};
                $agendaF->{$week[$i].'_morning_start_time'}     = $agenda->{$week[$i].'_morning_start_time'};
                $agendaF->{$week[$i].'_morning_end_time'}       = $agenda->{$week[$i].'_morning_end_time'};

            }if($agenda->{$week[$i].'_afternoon'} == 1){
                //Add como atributos os horários
                $agendaF->{$week[$i].'_afternoon'}              = $agenda->{$week[$i].'_afternoon'};
                $agendaF->{$week[$i].'_afternoon_start_time'}   = $agenda->{$week[$i].'_afternoon_start_time'};
                $agendaF->{$week[$i].'_afternoon_end_time'}     = $agenda->{$week[$i].'_afternoon_end_time'};
            } 
          }
      }

      $pro = 'pro1';
      $obj = (object) [];

      $obj->{$pro} = "propirties";

        return response()->json($agendaF);
    }
}
