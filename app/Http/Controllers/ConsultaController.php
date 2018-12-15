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

            // return Consulta::getConsultas($request->id, $request->date, $nameOfDay);

            switch ($nameOfDay) {
                case 'sunday':
                  $boolean = DB::select(DB::raw("SELECT sunday, sunday_start_time, sunday_end_time, sunday_morning, sunday_afternoon FROM agendas WHERE medicoid = '$request->id'"));
                  if(isset($boolean)){}
                  foreach($boolean as $bool){}
                    if(isset($bool)){

                        $obj = (object) [
                            'date' => $request->date,
                            'nameOfDay' => $nameOfDay,
                            'boolean' => $bool->sunday,
                            'morning' => $bool->sunday_morning,
                            'afternoon' => $bool->sunday_afternoon,
                            'start' => $bool->sunday_start_time,
                            'end' => $bool->sunday_end_time,
                        ];

                        if($bool->sunday == 1){
                            if($request->turno == 1){
                                //select da parte da manhã
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.manha = 1 && cs.medicoid = '$request->id'
                                                                "));

                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));

                            }if($request->turno == 2){
                                //select da parte da tarde
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.tarde = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));

                            }
                        }if($bool->sunday == 0){
                            //Não atende neste dia
                        }

                        return response()->json(array(
                            'object' => $obj,
                        ));                        
                    }

                    // if($bool->sunday == 1 && $time >= $start && $time <= $end )
                        return response()->json('404');
                  break;
                case 'monday':
                  $boolean = DB::select(DB::raw("SELECT monday, monday_start_time, monday_end_time, monday_morning, monday_afternoon FROM agendas WHERE medicoid = '$request->id'"));
                  foreach($boolean as $bool){}
                    if(isset($bool)){

                        $obj = (object) [
                            'date' => $request->date,
                            'nameOfDay' => $nameOfDay,
                            'boolean' => $bool->monday,
                            'morning' => $bool->monday_morning,
                            'afternoon' => $bool->monday_afternoon,
                            'start' => $bool->monday_start_time,
                            'end' => $bool->monday_end_time,
                        ];

                        if($bool->monday == 1){
                            if($request->turno == 1){
                                //select da parte da manhã
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.manha = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));

                            }if($request->turno == 2){
                                //select da parte da tarde
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.tarde = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));
                            }
                        }if($bool->monday == 0){
                            //Não atende neste dia
                        }

                        return response()->json(array(
                            'object' => $obj,
                        ));

                    }
                        return response()->json('404');

                  break;

                case 'tuesday':
                  $boolean = DB::select(DB::raw("SELECT tuesday, tuesday_start_time, tuesday_end_time, tuesday_morning, tuesday_afternoon FROM agendas WHERE medicoid = '$request->id'"));
                  foreach($boolean as $bool){}
                    if(isset($bool)){

                        $obj = (object) [
                            'date' => $request->date,
                            'nameOfDay' => $nameOfDay,
                            'boolean' => $bool->tuesday,
                            'morning' => $bool->tuesday_morning,
                            'afternoon' => $bool->tuesday_afternoon,
                            'start' => $bool->tuesday_start_time,
                            'end' => $bool->tuesday_end_time,
                        ];

                        if($bool->tuesday == 1){
                            if($request->turno == 1){
                                //select da parte da manhã
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.manha = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));

                            }if($request->turno == 2){
                                //select da parte da tarde
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.tarde = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));
                            }
                        }if($bool->tuesday == 0){
                            //Não atende neste dia
                        }

                        return response()->json(array(
                            'object' => $obj,
                        ));

                    }
                        return response()->json('404');

                  break;

                case 'wednesday':
                  $boolean = DB::select(DB::raw("SELECT wednesday, wednesday_start_time, wednesday_end_time, wednesday_morning, wednesday_afternoon FROM agendas WHERE medicoid = '$request->id'"));
                  foreach($boolean as $bool){}
                    if(isset($bool)){

                        $obj = (object) [
                            'date' => $request->date,
                            'nameOfDay' => $nameOfDay,
                            'boolean' => $bool->wednesday,
                            'morning' => $bool->wednesday_morning,
                            'afternoon' => $bool->wednesday_afternoon,
                            'start' => $bool->wednesday_start_time,
                            'end' => $bool->wednesday_end_time,
                        ];

                        if($bool->wednesday == 1){
                            if($request->turno == 1){
                                //select da parte da manhã
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.manha = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));

                            }if($request->turno == 2){
                                //select da parte da tarde
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.tarde = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));

                            }
                        }if($bool->wednesday == 0){
                            //Não atende neste dia
                        }

                        return response()->json(array(
                            'object' => $obj,
                        ));

                    }
                        return response()->json('404');

                  break;

                case 'thursday':
                  $boolean = DB::select(DB::raw("SELECT thursday, thursday_start_time, thursday_end_time, thursday_morning, thursday_afternoon FROM agendas WHERE medicoid = '$request->id'"));
                  foreach($boolean as $bool){}
                    if(isset($bool)){

                        $obj = (object) [
                            'date' => $request->date,
                            'nameOfDay' => $nameOfDay,
                            'boolean' => $bool->thursday,
                            'morning' => $bool->thursday_morning,
                            'afternoon' => $bool->thursday_afternoon,
                            'start' => $bool->thursday_start_time,
                            'end' => $bool->thursday_end_time,
                        ];

                        if($bool->thursday == 1){
                            if($request->turno == 1){
                                //select da parte da manhã
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.manha = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));
                            }if($request->turno == 2){
                                //select da parte da tarde
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.tarde = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));
                            }
                        }if($bool->thursday == 0){
                            //Não atende neste dia
                        }

                        return response()->json(array(
                            'object' => $obj,
                        ));

                    }
                        return response()->json('404');
                  break;

                case 'friday':
                  $boolean = DB::select(DB::raw("SELECT friday, friday_start_time, friday_end_time, friday_morning, friday_afternoon FROM agendas WHERE medicoid = '$request->id'"));
                  foreach($boolean as $bool){}
                    if(isset($bool)){

                        $obj = (object) [
                            'date' => $request->date,
                            'nameOfDay' => $nameOfDay,
                            'boolean' => $bool->friday,
                            'morning' => $bool->friday_morning,
                            'afternoon' => $bool->friday_afternoon,
                            'start' => $bool->friday_start_time,
                            'end' => $bool->friday_end_time,
                        ];

                        if($bool->friday == 1){
                            if($request->turno == 1){
                                //select da parte da manhã
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.manha = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));

                            }if($request->turno == 2){
                                //select da parte da tarde
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.tarde = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));
                            }
                        }if($bool->friday == 0){
                            //Não atende neste dia
                        }

                        return response()->json(array(
                            'object' => $obj,
                        ));
                        
                    }
                        return response()->json('404');

                  break;

                case 'saturday':
                  $boolean = DB::select(DB::raw("SELECT saturday, saturday_start_time, saturday_end_time, saturday_morning, saturday_afternoon  FROM agendas WHERE medicoid = '$request->id'"));
                  foreach($boolean as $bool){}
                    if(isset($bool)){

                        $obj = (object) [
                            'date' => $request->date,
                            'nameOfDay' => $nameOfDay,
                            'boolean' => $bool->saturday,
                            'morning' => $bool->saturday_morning,
                            'afternoon' => $bool->saturday_afternoon,
                            'start' => $bool->saturday_start_time,
                            'end' => $bool->saturday_end_time,
                        ];

                        if($bool->saturday == 1){
                            if($request->turno == 1){
                                //select da parte da manhã
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.manha = 1 && cs.medicoid = '$request->id'
                                                                "));

                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));

                            }if($request->turno == 2){
                                //select da parte da tarde
                                $consultas = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                                 FROM pacientes p
                                                                 LEFT JOIN convenios cv
                                                                 ON cv.pacienteid = p.idpaciente
                                                                 LEFT JOIN  planos pl
                                                                 ON cv.planoid = pl.idplano
                                                                 LEFT JOIN  consultas cs
                                                                 ON cs.pacienteid = p.idpaciente
                                                                 LEFT JOIN  medicos m
                                                                 ON cs.medicoid = m.idmedico
                                                                 WHERE cs.data_consulta = '$request->date' && cs.tarde = 1 && cs.medicoid = '$request->id'
                                                                "));
                                return response()->json(array(
                                    'object' => $obj,
                                    'consultas' => $consultas,
                                ));
                            }
                        }if($bool->saturday == 0){
                            //Não atende neste dia
                        }

                        return response()->json(array(
                            'object' => $obj,
                        ));                       
                    }
                        return response()->json('404');

                  break;

                default:

                    $obj = (object) [
                        'day' => $nameOfDay,
                        'boolean' => '404',
                    ];

                  break;
            }
        }
    }

    public function findPaciente(Request $request)
    {
        if($request->input('Nnome')){
            $string = $request->input('Nnome');
            $pacientes = DB::table('pacientes')
                           ->leftJoin('convenios', 'pacientes.idpaciente', '=', 'convenios.pacienteid')
                           ->leftJoin('planos', 'convenios.planoid', '=', 'planos.idplano')
                           ->select('pacientes.idpaciente', 'pacientes.nome', 'pacientes.nascimento', 'pacientes.cpf', 'planos.nome AS convenio')
                           ->where('pacientes.nome', 'like', '%'.$string.'%')
                           ->orderBy('pacientes.nome', 'asc')
                           ->get();

            // return view('paciente.find', compact('pacientes', 'planos'));
            //$pacientes = (object) array('pacientes' => $paci);
            return response()->json($pacientes);
        }
        if($request->input('Ncpf')){
            $cpf = $request->input('Ncpf');
            $pacientes = Paciente::select('idpaciente', 'nome', 'nascimento', 'cpf')
                           ->where('cpf', $cpf)
                           ->get();

            // return view('paciente.find', compact('pacientes', 'planos'));
            return response()->json($pacientes);
        }
        if($request->input('Nnasc')){
            $date = $request->input('Nnasc');
            $pacientes = DB::table('pacientes')
                           ->select('idpaciente', 'nome', 'nascimento', 'cpf')
                           ->where('nascimento', $date)
                           ->get();

            // return view('paciente.find', compact('pacientes', 'planos'));
            return response()->json($pacientes);
        }else{
            // $pacientes = Paciente::select('idpaciente', 'nome', 'nascimento', 'cpf')
            //                      ->paginate(5);

            // return view('paciente.find', compact('pacientes', 'planos'));
            $pacientes = (object) [
                'index' => 'no result',
                'error' => '404',
            ];
            return response()->json($pacientes);
        } 

        return response()->json($request);
    }

    public function addConsulta(Request $request)
    {
        if($request->ajax()){
            $manha          = $request->input('Nhor') == 1 ? 1 : 0;
            $tarde          = $request->input('Nhor') == 2 ? 1 : 0;
            $data           = $request->input('Ndata');
            $idmedico       = $request->input('Nmed');
            $idpaciente     = $request->input('Npaciente');

            $consulta = Consulta::create([
                'data_consulta'   => $request->input('Ndata'),
                'horario'         => '00:00:00',
                'manha'           => $manha,
                'tarde'           => $tarde,
                'pacienteid'      => $request->input('Npaciente'),
                'medicoid'        => $request->input('Nmed'),
            ]);
            
            if(isset($data,$idmedico, $idpaciente) && $manha == 1){
                $pacientes = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                 FROM pacientes p
                                                 LEFT JOIN convenios cv
                                                 ON cv.pacienteid = p.idpaciente
                                                 LEFT JOIN  planos pl
                                                 ON cv.planoid = pl.idplano
                                                 LEFT JOIN  consultas cs
                                                 ON cs.pacienteid = p.idpaciente
                                                 LEFT JOIN  medicos m
                                                 ON cs.medicoid = m.idmedico
                                                 WHERE cs.data_consulta = '$data' && cs.manha = 1 && cs.medicoid = '$idmedico' && cs.pacienteid = '$idpaciente'
                                                "));
                // foreach ($pacientes as $paciente) {}
                return response()->json($pacientes);               
            }if(isset($data,$idmedico, $idpaciente) && $tarde == 1){
                $pacientes = DB::select(DB::raw("SELECT p.idpaciente, p.nome, p.cpf, pl.nome as 'convenio'
                                                 FROM pacientes p
                                                 LEFT JOIN convenios cv
                                                 ON cv.pacienteid = p.idpaciente
                                                 LEFT JOIN  planos pl
                                                 ON cv.planoid = pl.idplano
                                                 LEFT JOIN  consultas cs
                                                 ON cs.pacienteid = p.idpaciente
                                                 LEFT JOIN  medicos m
                                                 ON cs.medicoid = m.idmedico
                                                 WHERE cs.data_consulta = '$data' && cs.manha = 1 && cs.medicoid = '$idmedico' && cs.pacienteid = '$idpaciente'
                                                "));
                // foreach ($pacientes as $paciente) {}
                return response()->json($pacientes);  
            }else{
                $paciente = (object) [
                    'error' => '404',
                ];
                return response()->json($paciente);
            }

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
