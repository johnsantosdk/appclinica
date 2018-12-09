<?php

namespace App\Http\Controllers;

use App\Consulta;
use Illuminate\Http\Request;
use App\Medicoespecialidade;
use App\Especialidade;
use App\Paciente;
use App\Plano;
use App\Agenda;
use Illuminate\Support\Facades\DB;
class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('consulta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $especialidades = Especialidade::all();
        //return $especialidades;
        return view('consulta.create', compact('especialidades'));
    }

    public function ajaxRequestMedico(Request $request)
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

    public function ajaxFiltroDateTime(Request $request)
    {
        if($request->ajax()){

            $nameOfDay = date('D', strtotime($request->date));

            $agenda = DB::select(DB::raw(""));

            return response()->json($nameOfDay);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        return redirect('consulta.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consulta $consulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consulta $consulta)
    {
        //
    }
}
