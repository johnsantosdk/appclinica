<?php

namespace App\Http\Controllers;

use App\Medico;
use App\Especialidade;
use App\Medicos_Especialidade;
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

            //Find the especialidade
            $esp = Especialidade::find($request->input('Nesp'));
            //Insere
            $medico_esp = Medicos_Especialidade::create([
                'medicoid' => $medico->idmedico,
                'especialidadeid' => $esp->idespecialidade,
            ]);

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
        return view('medico.find');
    }

    public function list(Request $request)
    {
        //$medicos = Medico::select('idmedico, nome, crm')->get();
        //$medicos = DB::table('medicos')->select('idmedico, nome, crm')->get();
        $medicos =  DB::select(DB::raw("SELECT idmedico, nome, crm FROM medicos"));

        return view('medico.find', compact('medicos'));
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
