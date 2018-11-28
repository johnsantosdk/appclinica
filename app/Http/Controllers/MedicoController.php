<?php

namespace App\Http\Controllers;

use App\Medico;
use App\Especialidade;
use App\Medicoespecialidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('medico.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$especialidades = Especialidade::select('idespecialidade, nome')->get();
        $especialidades = DB::select(DB::raw("SELECT idespecialidade, nome, cbo FROM especialidades ORDER BY cbo ASC"));
        
        return view('medico.create', compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request)) {
            $medico = Medico::create([
                'nome'  => $request->input('Nnome'),
                'sexo'  => $request->input('Nsexo'),
                'cpf'   => $request->input('Ncpf'),
                'crm'   => $request->input('Ncrm'),
            ]);

            $idesp = $request->input('Nesp');

            if(isset($idesp)){
                //Find the especialidade
                $esp = Especialidade::find($idesp);
                //Insere
                $medico_esp = Medicoespecialidade::create([
                    'medicoid' => $medico->idmedico,
                    'especialidadeid' => $esp->idespecialidade,
                ]);
            }
            Session::flash('flash_message', [
                'msg' => "Médico cadastrado  com SUCESSO!",
                'class'  => "alert-success"
            ]);

            return redirect()->route('medico.create');
        }

        return redirect()->route('medico.create')->withInput(); 
    }

    public function find()
    {
        $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));

        return view('medico.find', compact('especialidades'));
    }

    public function list(Request $request)
    {
        if(isset($request)){
            $idesp = $request->input('Nesp');
            $nome = $request->input('Nnome');
            $crm = $request->input('Ncrm');

            if(isset($idesp, $nome, $crm)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade' 
                                               FROM medicos m 
                                               LEFT JOIN medicoespecialidades me 
                                               ON m.idmedico = me.medicoid 
                                               LEFT JOIN especialidades e 
                                               ON e.idespecialidade = me.especialidadeid 
                                               WHERE me.especialidadeid = '$idesp' AND m.nome LIKE '%$nome%' AND m.crm = '$crm'
                                             "));
                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                return view('medico.find', compact('medicos', 'especialidades'));
            }
            if(isset($idesp, $nome)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade' 
                                               FROM medicos m 
                                               LEFT JOIN medicoespecialidades me 
                                               ON m.idmedico = me.medicoid 
                                               LEFT JOIN especialidades e 
                                               ON e.idespecialidade = me.especialidadeid 
                                               WHERE me.especialidadeid = '$idesp' AND m.nome LIKE '%$nome%'
                                             "));
                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                return view('medico.find', compact('medicos', 'especialidades'));
            }
            if(isset($idesp, $crm)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade' 
                                               FROM medicos m 
                                               LEFT JOIN medicoespecialidades me 
                                               ON m.idmedico = me.medicoid 
                                               LEFT JOIN especialidades e 
                                               ON e.idespecialidade = me.especialidadeid 
                                               WHERE me.especialidadeid = '$idesp' AND m.crm = '$crm'
                                             "));
                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                return view('medico.find', compact('medicos', 'especialidades'));
            }
            if(isset($nome, $crm)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade' 
                                               FROM medicos m 
                                               LEFT JOIN medicoespecialidades me 
                                               ON m.idmedico = me.medicoid 
                                               LEFT JOIN especialidades e 
                                               ON e.idespecialidade = me.especialidadeid 
                                               WHERE  m.nome LIKE '%$nome%' AND m.crm = '$crm'
                                             "));
                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                return view('medico.find', compact('medicos', 'especialidades'));
            }   
            if(isset($idesp)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade' 
                                               FROM medicos m 
                                               LEFT JOIN medicoespecialidades me 
                                               ON m.idmedico = me.medicoid 
                                               LEFT JOIN especialidades e 
                                               ON e.idespecialidade = me.especialidadeid 
                                               WHERE me.especialidadeid = '$idesp'
                                             "));
                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                return view('medico.find', compact('medicos', 'especialidades'));
            }         
            if(isset($nome)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade' 
                                               FROM medicos m 
                                               LEFT JOIN medicoespecialidades me 
                                               ON m.idmedico = me.medicoid 
                                               LEFT JOIN especialidades e 
                                               ON e.idespecialidade = me.especialidadeid 
                                               WHERE m.nome LIKE '%$nome%'
                                             "));
                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                return view('medico.find', compact('medicos', 'especialidades'));
            }
            if(isset($crm)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade' 
                                               FROM medicos m 
                                               LEFT JOIN medicoespecialidades me 
                                               ON m.idmedico = me.medicoid 
                                               LEFT JOIN especialidades e 
                                               ON e.idespecialidade = me.especialidadeid 
                                               WHERE m.crm = '$crm'
                                             "));
                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                return view('medico.find', compact('medicos', 'especialidades'));
            }
            else{
            $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade' 
                                                   FROM medicos m 
                                                   LEFT JOIN medicoespecialidades me 
                                                   ON m.idmedico = me.medicoid 
                                                   LEFT JOIN especialidades e 
                                                   ON e.idespecialidade = me.especialidadeid
                                                 "));

            $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
            
            return view('medico.find', compact('medicos', 'especialidades'));
            }
        }


    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Medico $medico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit(Medico $medico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medico $medico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medico)
    {
        //
    }
}
