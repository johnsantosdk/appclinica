<?php

namespace App\Http\Controllers;

use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Plano;
use App\Convenio;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paciente.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $planos = DB::table('planos')->select('id', 'nome')->where('status_plano', '=', 1)->orderBy('nome')->get();
        
        return view('paciente.create', compact('planos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $convenio = Convenio::create([
            'matricula' => $request->input('Nmat'),
            'plano' => $request->input('Nplano'),
        ]);

        $plano = Convenio::select('id')->where('matricula', '=', $convenio->matricula)->first();
   
        $paciente = Paciente::create([
            'nome'            => $request->input('Nnome'),
            'data_nascimento' => $request->input('Nnasc'),
            'cpf'             => $request->input('Ncpf'),
            'email'           => $request->input('Nemail'),
            'atendente_id'    => $request->input('NidAten', 1),
            'convenio_id'     => $plano->id,
        ]);

        Session::flash('flash_message', [
                'msg' => "Paciente cadastrado  com SUCESSO!",
                'class'  => "alert-success"
        ]);


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $cpf = $request->input('Ncpf');
        //$paciente = Paciente::find();
        $paciente = DB::table('pacientes')->select('id', 'nome', 'data_nascimento', 'cpf', 'email')->where('cpf', $cpf)->get();

        return $paciente;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        //
    }

    public function listPlanos()
    {
        //
    }
}
