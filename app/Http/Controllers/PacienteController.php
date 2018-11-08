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
        $planos = DB::table('planos')->select('idplano', 'nome')->where('status', '=', 1)->orderBy('nome')->get();
        
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
            'sexo'            => $request->input('Nsexo'),
            'nascimento'      => $request->input('Nnasc'),
            'cpf'             => $request->input('Ncpf'),
            'email'           => $request->input('Nemail'),
        ]);
        //capturando o id inserido para poder gravar o convenio e os telefones se existirem
        $pacienteId = Paciente::select('idpaciente')->where('cpf', '=', $paciente->cpf)->first();

        //Cadastro do convenio do paciente
        if($request->input('Nmat')){
            $convenio = Convenio::create([
                'matricula'     => $request->input('Nmat'),
                'planoid'      => $request->input('NplanoId'),
                'pacienteid'   => $pacienteId->id,
            ]);
            //Captura o id gerado acima
            //$convenioId = Convenio::select('idconvenio')->where('matricula', '=', $convenio->matricula)->first();
            //enserir no campo convenio_id da tabela paciente
            //DB::table('pacientes')->where('idpaciente', $pacienteId->id)->update(['convenio_id' => $convenioId->id]);
        }
        //Inserção dos telefones 
       if($request->input('NtelR')){
            $telefone = Telefone::create([
                'tipo'          => 'RES',
                'numero'        => $request->input('NtelR'),
                'pacienteid'   => $pacienteId->id,
            ]);

            //$telefoneId = Telefone::select('id')->where('numero', '=', $telefone->numero)->first();

            //DB::table('pacientes')->where('id', $pacienteId->id)->update(['telefone_id' => $telefoneId->id]);
        }
        if($request->input('NtelE')){
            $telefone = Telefone::create([
                'tipo'          => 'EMP',
                'numero'        => $request->input('NtelE'),
                'pacienteid'   => $pacienteId->id,
            ]);

            //$telefoneId = Telefone::select('id')->where('numero', '=', $telefone->numero)->first();

            //DB::table('pacientes')->where('id', $pacienteId->id)->update(['telefone_id' => $telefoneId->id]);
        }
        if($request->input('NtelC')){
            $telefone = Telefone::create([
                'tipo'          => 'CEL',
                'numero'        => $request->input('NtelC'),
                'pacienteid'   => $pacienteId->id,
            ]);

            //$telefoneId = Telefone::select('id')->where('numero', '=', $telefone->numero)->first();

            //DB::table('pacientes')->where('id', $pacienteId->id)->update(['telefone_id' => $telefoneId->id]);
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
    public function findPaciente(Request $request)
    {
        //$cpf = $request->input('Ncpf');
        //$paciente = Paciente::find();
        //$paciente = DB::table('pacientes')->select('id', 'nome', 'data_nascimento', 'sexo', 'cpf', 'email')->where('cpf', $cpf)->first();

        return view('paciente.find');
    }

    public function listPaciente(Request $request)
    {
        
        if($request->input('Nnome')){
            $string = $request->input('Nnome');
            $pacientes = DB::table('pacientes')
                           ->select('pacientes.idpaciente', 'pacientes.nome', 'pacientes.nascimento', 'pacientes.cpf')
                           ->where('nome', 'like', '%'.$string.'%')
                           ->orderBy('nome', 'asc')
                           ->get();
        }

        
        if($request->input('Ncpf')){
            $cpf = $request->input('Ncpf');
            $pacientes = Paciente::select('idpaciente', 'nome', 'nascimento', 'cpf')
                           ->where('cpf', $cpf)
                           ->get();
        }

        if($request->input('Nnasc')){
            $date = $request->input('Nnasc');
            $pacientes = DB::table('pacientes')
                           ->select('idpaciente', 'nome', 'nascimento', 'cpf')
                           ->where('nascimento', $date)
                           ->get();
        }
/**
        if($request->input('Nnome') || $request->input('Ncpf') || $request->input('Nnasc')){
            $pacientes = DB::table('pacientes')->select('id', 'nome', 'data_nascimento', 'cpf')->where('nome', 'like', '%'.$request->input('Nnome').'%')->orWhere('cpf', $request->input('Ncpf'))->orWhere('data_nascimento', $request->input('Nnasc'))->paginate(15);
        }**/

        $planos = DB::table('planos')->select('idplano', 'nome')->where('status', '=', 1)->orderBy('nome')->get();
        
        return view('paciente.find', compact('pacientes', 'planos'));
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

    public function editPaciente(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            
         /**   $paciente = DB::table('pacientes')
                          ->leftJoin('convenios', 'convenios.paciente_id', '=', 'pacientes.id')
                          ->leftJoin('telefones', 'telefones.paciente_id', '=', 'pacientes.id')
                          ->select('pacientes.nome, pacientes.sexo, pacientes.data_nascimento, pacientes.cpf, pacientes.email, telefones.tipo, telefones.numero, convenios.id, convenios.matricula, convenios.plano_id')
                          ->where('pacientes.id', '=', $id)
                          ->get();**/
            //$paciente = Paciente::find($id);
            //$convenio = "convenios";
            $paciente = DB::select('call getpaciente(?)', array($id));
            
            return response($paciente);
        }

        return response('nada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function updatePaciente(Request $request)
    {
        $id = $request->input('NidPaci');
        $telR = $request->input('NtelR');
        $telE = $request->input('NtelE');
        $telC = $request->input('NtelC');

        if($request->ajax()){
            $paciente = DB::table('pacientes')
                          ->where('idpaciente', $id)
                          ->update(['nome'          => $request->input('Nnome')],
                                   ['sexo'          => $request->input('Nsexo')],
                                   ['nascimento'    => $request->input('Nnasc')],
                                   ['cpf'           => $request->input('Ncpf')],
                                   ['email'         => $request->input('Nemail')]
                                  );

            if(isset($telR)){
                $telIdR = DB::select(DB::raw("select idtelefone, numero from telefones where ((pacienteid = '$id') and (tipo = 'RES'))"));
                
                if(isset($telIdR[0]->idtelefone, $telIdR[0]->numero)){
                    if($telIdR[0]->numero != $telR){
                        $telefoneR = DB::table('telefones')
                                       ->where('idtelefone', $telIdR[0]->idtelefone)
                                       ->update(['numero' => $telR]);
                    }
                }if(!isset($telIdR[0]->idtelefone)){
                    $telefoneR = new Telefone;
                    $telefoneR->tipo = 'RES';
                    $telefoneR->numero = $telR;
                    $telefoneR->pacienteid = $id;
                    $telefoneR->save();
                }
            }
            if(isset($telE)){
                $telIdE = DB::select(DB::raw("select idtelefone, numero from telefones where ((pacienteid = '$id') and (tipo = 'EMP'))"));
                if(isset($telIdE[0]->idtelefone, $telIdE[0]->numero)){
                    if($telIdE[0]->numero != $telE){
                        $telefoneE = DB::table('telefones')
                                       ->where('idtelefone', $telIdE[0]->idtelefone)
                                       ->update(['numero' => $telE]);
                    }
                }if(!isset($telIdE[0]->idtelefone)){
                    $telefoneE = new Telefone;
                    $telefoneE->tipo = 'EMP';
                    $telefoneE->numero = $telE;
                    $telefoneE->pacienteid = $id;
                    $telefoneE->save();
                }
            }
            if(isset($telC)){
                $telIdC = DB::select(DB::raw("select idtelefone, numero from telefones where ((pacienteid = '$id') and (tipo = 'CEL'))"));
                if(isset($telIdC[0]->idtelefone, $telIdC[0]->numero)){
                    if($telIdC[0]->numero != $telC){
                        $telefoneC = DB::table('telefones')
                                    ->where('idtelefone', $telIdC[0]->idtelefone)
                                    ->update(['numero' => $telC]);
                    }
                }
                if(!isset($telIdC[0]->idtelefone)){
                    $telefoneC = new Telefone;
                    $telefoneC->tipo = 'CEL';
                    $telefoneC->numero = $telC;
                    $telefoneC->pacienteid = $id;
                    $telefoneC->save();
                }
            }
            $mat = $request->input('Nmat');
            $tipo = $request->input('NplanoId');
            if(isset($mat, $tipo)){
                $convId = Convenio::select('idconvenio')->where('pacienteid', '=', $id)->first();
                if(isset($convId)){
                    $convenio = DB::table('convenios')
                                  ->where('idconvenio', $convId)
                                  ->update(['matricula' => $mat],
                                           ['planoid'   => $tipo]
                                          );
                }if(!isset($convId)){
                    $convenio = new Convenio;
                    $convenio->matricula    = $request->input('Nmat');
                    $convenio->planoid      = $request->input('NidPlan');
                    $convenio->pacienteid   = $id;
                    $convenio->save();
                }
            }
            //return view('paciente.find', compact($p));
            return response($request);
        }  
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
}
