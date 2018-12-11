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

            $nameOfDay = strtolower(date('l', strtotime($request->date)));

        switch ($nameOfDay) {
            case 'sunday':
              $boolean = DB::select(DB::raw("SELECT sunday FROM agendas WHERE medicoid = '$request->id'"));
              if(isset($boolean)){}
              foreach($boolean as $bool){}
                $obj = (object) [
                    'date' => $request->date,
                    'nameOfDay' => $nameOfDay,
                    'boolean' => $bool->sunday,
                    'start' => $bool->sunday_start_time,
                    'end' => $bool->sunday_end_time,
                ];
                $start = strtotime($bool->sunday_start_time);
                $end   = strtotime($bool->sunday_end_time);
                $time  = strtotime($request->time);
                // if($bool->sunday == 1 && $time >= $start && $time <= $end )
        
              break;
            case 'monday':
              $boolean = DB::select(DB::raw("SELECT monday, monday_start_time, monday_end_time FROM agendas WHERE medicoid = '$request->id'"));
              foreach($boolean as $bool){}
                $obj = (object) [
                    'date' => $request->date,
                    'nameOfDay' => $nameOfDay,
                    'boolean' => $bool->monday,
                    'start' => $bool->monday_start_time,
                    'end' => $bool->monday_end_time,
                ];
              break;

            case 'tuesday':
              $boolean = DB::select(DB::raw("SELECT tuesday, tuesday_start_time, tuesday_end_time FROM agendas WHERE medicoid = '$request->id'"));
              foreach($boolean as $bool){}
                $obj = (object) [
                    'date' => $request->date,
                    'nameOfDay' => $nameOfDay,
                    'boolean' => $bool->tuesday,
                    'start' => $bool->tuesday_start_time,
                    'end' => $bool->tuesday_end_time,
                ];
              break;

            case 'wednesday':
              $boolean = DB::select(DB::raw("SELECT wednesday, wednesday_start_time, wednesday_end_time FROM agendas WHERE medicoid = '$request->id'"));
              foreach($boolean as $bool){}
                
                $obj = (object) [
                    'date' => $request->date,
                    'nameOfDay' => $nameOfDay,
                    'boolean' => $bool->wednesday,
                    'start' => $bool->wednesday_start_time,
                    'end' => $bool->wednesday_end_time,
                ];
              break;

            case 'thursday':
              $boolean = DB::select(DB::raw("SELECT thursday, thursday_start_time, thursday_end_time FROM agendas WHERE medicoid = '$request->id'"));
              foreach($boolean as $bool){}
                $obj = (object) [
                    'date' => $request->date,
                    'nameOfDay' => $nameOfDay,
                    'boolean' => $bool->thursday,
                    'start' => $bool->thursday_start_time,
                    'end' => $bool->thursday_end_time,
                ];
              break;

            case 'friday':
              $boolean = DB::select(DB::raw("SELECT friday, friday_start_time, friday_end_time FROM agendas WHERE medicoid = '$request->id'"));
              foreach($boolean as $bool){}
                $obj = (object) [
                    'date' => $request->date,
                    'nameOfDay' => $nameOfDay,
                    'boolean' => $bool->friday,
                    'start' => $bool->friday_start_time,
                    'end' => $bool->friday_end_time,
                ];
              break;

            case 'saturday':
              $boolean = DB::select(DB::raw("SELECT saturday, friday_start_time, friday_end_time FROM agendas WHERE medicoid = '$request->id'"));
              foreach($boolean as $bool){}
                $obj = (object) [
                    'date' => $request->date,
                    'nameOfDay' => $nameOfDay,
                    'boolean' => $bool->saturday,
                    'start' => $bool->saturday_start_time,
                    'end' => $bool->saturday_end_time,
                ];
              break;

            default:
                $obj = (object) [
                    'day' => $nameOfDay,
                    'boolean' => '404',
                ];
              break;
        }


            return response()->json($obj);
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
