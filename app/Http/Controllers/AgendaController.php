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
    	$medicoid = $request->input('Nmed');
    	$especialidadeid = $request->input('Nesp');

    	if($request->ajax()){

    		if(isset($medicoid, $especialidadeid)){
	    		
    		    $agenda = Agenda::getAgendaMedico($medicoid, $especialidadeid);

                if(isset($agenda)){

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

            }

    	}
    }
}
