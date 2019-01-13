<?php

namespace App\Http\Controllers;

use App\Consulta;
use Illuminate\Http\Request;
use App\Http\Requests\ConsultaRequest;
use App\Medicoespecialidade;
use App\Especialidade;
use App\Paciente;
use App\Plano;
use App\Agenda;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
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

        $turno = $request->turno == 1 ? 'manha':'tarde';

        $nameOfDay = strtolower(date('l', strtotime($request->date)));

        // para cada dia da semana
        $results = Agenda::getFiltroAgenda($request->date, $turno, $request->id);
        
        if(isset($results)){foreach($results as $result){}}//continue

        if(isset($result)){
            //Se o $result não estiver vazio será criado um obj para armazenar o resulta da query
                $obj = (object) [
                    'date'              => $request->date,
                    'nameOfDay'         => $nameOfDay,
                    'boolean'           => $result->{$nameOfDay},
                    'morning'           => $result->{$nameOfDay.'_morning'},
                    'morningStart'      => $result->{$nameOfDay.'_morning_start_time'},
                    'morningEnd'        => $result->{$nameOfDay.'_morning_end_time'},
                    'afternoon'         => $result->{$nameOfDay.'_afternoon'},
                    'afternoonStart'    => $result->{$nameOfDay.'_afternoon_start_time'},
                    'afternoonEnd'      => $result->{$nameOfDay.'_afternoon_end_time'},
                ];

            if($result->{$nameOfDay} == 1){
                if(isset($request->turno)){

                    $consultas = Consulta::getConsultaMedico($request->date, $turno, $request->id);

                    return response()->json(array(
                        'object' => $obj,
                        'consultas' => $consultas,
                    ));

                }
            }if($result->{$nameOfDay} == 0){
                //Não atende neste dia então retorna um obj com os detalhes
                    return response()->json(array(
                        'object' => $obj,
                    ));
                }                        
        }
        //Não encontrado
        return response()->json('404');

        }
    }

    public function findPaciente(Request $request)
    {
        if($request->input('Ncpf')){
            $cpf = $request->input('Ncpf');
            $pacientes = Paciente::leftJoin('convenios', 'pacientes.idpaciente', '=', 'convenios.pacienteid')
                                 ->leftJoin('planos', 'convenios.planoid', '=', 'planos.idplano')
                                 ->select('pacientes.idpaciente', 'pacientes.nome', 'pacientes.nascimento', 'pacientes.cpf', 'planos.nome AS convenio')
                                 ->where('cpf', $cpf)
                                 ->get();

            // return view('paciente.find', compact('pacientes', 'planos'));
            return response()->json($pacientes);
        }
        if($request->input('Nnasc')){
            $date = $request->input('Nnasc');
            $pacientes = DB::table('pacientes')
                           ->leftJoin('convenios', 'pacientes.idpaciente', '=', 'convenios.pacienteid')
                           ->leftJoin('planos', 'convenios.planoid', '=', 'planos.idplano')
                           ->select('pacientes.idpaciente', 'pacientes.nome', 'pacientes.nascimento', 'pacientes.cpf', 'planos.nome AS convenio')
                           ->where('nascimento', $date)
                           ->get();

            // return view('paciente.find', compact('pacientes', 'planos'));
            return response()->json($pacientes);
        }
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
        else{
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


    public function addConsulta(ConsultaRequest $request)
    {
        $turno          = $request->input('Nhor') == 1 ? 'manha' : 'tarde';
        $manha          = $request->input('Nhor') == 1 ? 1 : 0;
        $tarde          = $request->input('Nhor') == 2 ? 1 : 0;
        $horario        = $request->input('Nhor') == 1 ? '08:00:00' : '14:00:00';
        $data           = $request->input('Ndata');
        $idmedico       = $request->input('Nmed');
        $idpaciente     = $request->input('Npaciente');

        //Verifica se o paciente já está agendado para os termos informados
        $result = Consulta::getConsultaId($idmedico, $idpaciente, $data, $turno, 1);


            if($request->ajax()){
                if(isset($result)){
                   return response()->json(array(
                        'consulta' => $result,
                        'error-code' => '1062',
                   )); 
                }else{
                    $consulta = Consulta::create([
                        'data_consulta'   => $request->input('Ndata'),
                        'horario'         => $horario,
                        'manha'           => $manha,
                        'tarde'           => $tarde,
                        'pacienteid'      => $request->input('Npaciente'),
                        'medicoid'        => $request->input('Nmed'),
                    ]);
                    
                    if(isset($data, $idmedico, $idpaciente) && $manha == 1){
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
                        foreach ($pacientes as $paciente) {}

                        return response()->json(array(
                            'paciente' => $paciente,
                        )); 

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
                                                         WHERE cs.data_consulta = '$data' && cs.tarde = 1 && cs.medicoid = '$idmedico' && cs.pacienteid = '$idpaciente'
                                                        "));
                        foreach ($pacientes as $paciente) {}

                        return response()->json(array(
                            'paciente' => $paciente,
                        ));  

                    }else{
                        $paciente = (object) [
                            'error' => '404',
                        ];
                        return response()->json($paciente);
                    }
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
