<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Medicoespecialidade;
use App\Especialidade;
use App\Paciente;
use App\Plano;
use App\Agenda;


class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	return view('agenda.index');
    }

    public function create()
    {
    	$especialidades = Especialidade::all();

    	return view('agenda.create', compact('especialidades'));
    }

    public function getMedico(Request $request)
    {
        if($request->ajax()){

            $medico = DB::select(DB::raw("SELECT m.idmedico, m.nome 
                                          FROM medicos m 
                                          LEFT JOIN medicoespecialidades me 
                                          ON m.idmedico = me.medicoid 
                                          LEFT JOIN especialidades e 
                                          ON e.idespecialidade = me.especialidadeid
                                          WHERE me.especialidadeid = '$request->id';
                                        "));

            return response()->json($medico);
        }
    }

    public function getAgenda(Request $request)
    {
    	$medicoid          = $request->input('Nmed') !== null ? $request->input('Nmed') : $request->medid;
    	$especialidadeid   = $request->input('Nesp') !== null ? $request->input('Nesp') : $request->espid;

    	if($request->ajax()){

    		if(isset($medicoid, $especialidadeid)){
	    		
    		    $agenda = Agenda::getAgendaMedico($medicoid, $especialidadeid);

                if(isset($agenda) && is_object($agenda)){

                    return response()->json(array(
                        'exist'  => 1,
                        'agenda' => $agenda,
                    ));

                }else{
                    return response()->json(array(
                        'exist'  => 0,
                        'agenda' => '404',
                    ));
                }

            }else{
                return response()->json(array(
                    'error' => '400 bad Request',
                ));
            }

    	}
    }

    public function getAgendaFiltrada(Request $request)
    {
        $medicoid          = $request->input('Nmed') !== null ? $request->input('Nmed') : $request->medid;
        $especialidadeid   = $request->input('Nesp') !== null ? $request->input('Nesp') : $request->espid;

        if($request->ajax()){

            if(isset($medicoid, $especialidadeid)){
                
                $agenda = Agenda::getAgendaMedico($medicoid, $especialidadeid);
                //filtra a agenda
                $agendaf = Agenda::filtraAgendaMedico($agenda);


                if(isset($agendaf) && is_object($agendaf)){

                    return response()->json(array(
                        'exist'  => 1,
                        'agenda' => $agendaf,
                    ));

                }else{
                    return response()->json(array(
                        'exist'  => 0,
                        'agenda' => '404',
                    ));
                }

            }else{
                return response()->json(array(
                    'error' => '400 bad Request',
                ));
            }

        }
    }
}
