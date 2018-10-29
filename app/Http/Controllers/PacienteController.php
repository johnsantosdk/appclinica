<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Paciente;
use App\Plano;
use App\Convenio;
use App\Telefone;
use App\Http\Requests\MultiploFormPacienteRequest;

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
    public function store(MultiploFormPacienteRequest $request)
    {
        $validado = 1;

        //Persiste um novo paciente
        $paciente = Paciente::create([
            'nome'            => $request->input('Nnome'),
            'data_nascimento' => $request->input('Nnasc'),
            'sexo'            => $request->input('Nsexo'),
            'cpf'             => $request->input('Ncpf'),
            'email'           => $request->input('Nemail'),
        ]);
        //capturando o id inserido para poder gravar o convenio e os telefones se existirem
        $pacienteId = Paciente::select('id')->where('cpf', '=', $paciente->cpf)->first();

        //Cadastro do convenio do paciente
        if($request->input('Nmat')){
            $convenio = Convenio::create([
                'matricula'     => $request->input('Nmat'),
                'plano_id'      => $request->input('NplanoId'),
                'paciente_id'   => $pacienteId->id,
            ]);
            //Captura o id gerado acima
            $convenioId = Convenio::select('id')->where('matricula', '=', $convenio->matricula)->first();
            //enserir no campo convenio_id da tabela paciente
            DB::table('pacientes')->where('id', $pacienteId->id)->update(['convenio_id' => $convenioId->id]);
        }
        //Inserção dos telefones 
       if($request->input('NtelR')){
            $telefone = Telefone::create([
                'tipo'          => 'RES',
                'numero'        => $request->input('NtelR'),
                'paciente_id'   => $pacienteId->id,
            ]);

            $telefoneId = Telefone::select('id')->where('numero', '=', $telefone->numero)->first();

            DB::table('pacientes')->where('id', $pacienteId->id)->update(['telefone_id' => $telefoneId->id]);
        }
        if($request->input('NtelE')){
            $telefone = Telefone::create([
                'tipo'          => 'EMP',
                'numero'        => $request->input('NtelE'),
                'paciente_id'   => $pacienteId->id,
            ]);

            $telefoneId = Telefone::select('id')->where('numero', '=', $telefone->numero)->first();

            DB::table('pacientes')->where('id', $pacienteId->id)->update(['telefone_id' => $telefoneId->id]);
        }
        if($request->input('NtelC')){
            $telefone = Telefone::create([
                'tipo'          => 'CEL',
                'numero'        => $request->input('NtelC'),
                'paciente_id'   => $pacienteId->id,
            ]);

            $telefoneId = Telefone::select('id')->where('numero', '=', $telefone->numero)->first();

            DB::table('pacientes')->where('id', $pacienteId->id)->update(['telefone_id' => $telefoneId->id]);
        }

        if($validado == 1){
            Session::flash('flash_message', [
                'msg' => "Paciente cadastrado  com SUCESSO!",
                'class'  => "alert-success"
            ]);
            return redirect()->route('paciente.create');
        }

        return redirect()->route('paciente.create')->withInput(); 
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
        $paciente = DB::table('pacientes')->select('id', 'nome', 'data_nascimento', 'sexo', 'cpf', 'email')->where('cpf', $cpf)->first();

        return view('paciente.edit', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        

        return view('paciente.edit', compact('paciente'));
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
