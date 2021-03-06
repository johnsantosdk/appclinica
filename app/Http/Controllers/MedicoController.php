<?php

namespace App\Http\Controllers;

use App\Medico;
use App\Especialidade;
use App\Medicoespecialidade;
use Illuminate\Http\Request;
use App\Http\Requests\MedicoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MedicoController extends Controller
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
    public function store(MedicoRequest $request)
    {
        if (isset($request)) {
            $medico = Medico::create([
                'nome'        => $request->input('Nnome'),
                'nascimento'  => $request->input('Nnasc'),
                'sexo'        => $request->input('Nsexo'),
                'cpf'         => $request->input('Ncpf'),
                'crm'          => $request->input('Ncrm'),
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
            $nome = $request->input('Nnome');
            $crm = $request->input('Ncrm');

            if(isset($nome, $crm)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm
                                               FROM medicos m 
                                               WHERE m.nome LIKE '%$nome%' AND m.crm = '$crm'
                                             "));
                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                return view('medico.find', compact('medicos', 'especialidades'));
            }
            if(isset($nome)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm 
                                               FROM medicos m  
                                               WHERE m.nome LIKE '%$nome%'
                                             "));
                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                return view('medico.find', compact('medicos', 'especialidades'));
            }
            if(isset($crm)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm 
                                               FROM medicos m  
                                               WHERE m.crm = '$crm'
                                             "));
                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                return view('medico.find', compact('medicos', 'especialidades'));
            }            
            else{
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm
                                               FROM medicos m 
                                              "));

                $especialidades = DB::select(DB::raw("SELECT idespecialidade, cbo, nome  FROM especialidades ORDER BY cbo ASC"));
                
                return view('medico.find', compact('medicos', 'especialidades'));
            }
        }


    }
 /*       public function list(Request $request)
    {
        if(isset($request)){
            $idesp = $request->input('Nesp');
            $nome = $request->input('Nnome');
            $crm = $request->input('Ncrm');

            if(isset($idesp, $nome, $crm)){
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade', e.idespecialidade as 'idesp'
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
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade', e.idespecialidade as 'idesp' 
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
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade', e.idespecialidade as 'idesp' 
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
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade', e.idespecialidade as 'idesp' 
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
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade', e.idespecialidade as 'idesp' 
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
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade', e.idespecialidade as 'idesp' 
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
                $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade', e.idespecialidade as 'idesp' 
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
            $medicos = DB::select(DB::raw("SELECT m.idmedico, m.nome, m.crm, e.nome as 'especialidade', e.idespecialidade as 'idesp' 
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


    }*/
    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // return response()->json($request);
        if($request->ajax()){
          $medico = Medico::find($request->id);

          $especialidade = Especialidade::find($request->id2);

          if(isset($especialidade)){
            $medico['idesp'] = $especialidade->idespecialidade; 
          }

          return response()->json($medico);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request)
    {
        if($request->ajax()){
            $medico = Medico::find($request->id);

            $esps = DB::select(DB::raw("SELECT e.cbo, e.nome 
                                        FROM medicos m 
                                        LEFT JOIN medicoespecialidades me 
                                        ON m.idmedico = me.medicoid 
                                        LEFT JOIN especialidades e 
                                        ON e.idespecialidade = me.especialidadeid
                                        WHERE me.medicoid = '$medico->idmedico'
                                      "));
            $medico['especialidades'] = $esps;

            return response()->json($medico);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->ajax()){

          $medico = Medico::find($request->Nidmedico);

          if(isset($request->Nnome) && ($request->Nnome != $medico->nome)){
            $medico->nome = $request->Nnome;
          }
          if(isset($request->Nnasc) && ($request->Nnasc != $medico->nascimento)){
            $medico->nascimento = $request->Nnasc;
          }
          if(isset($request->Nsexo) && ($request->Nsexo != $medico->sexo)){
            $medico->sexo = $request->Nsexo;
          }
          if(isset($request->Ncpf) && ($request->Ncpf != $medico->cpf)){
            $medico->cpf = $request->Ncpf;
          }
          if(isset($request->Ncrm) && ($request->Ncrm != $medico->crm)){
            $medico->crm = $request->Ncrm;
          }
          //UPDATE
          $medico->save();
          if(isset($request->Nespid) && ($request->Nespid != $request->NoldIdesp)){
            
            $medEsp = DB::select(DB::raw("UPDATE medicoespecialidades SET especialidadeid = '$request->Nespid' WHERE medicoid = '$request->Nidmedico' && especialidadeid = '$request->NoldIdesp' "));
          }if(isset($request->NoldIdesp) && $request->NoldIdesp == null){
            //CREATE
            $medEsp = DB::select(DB::raw("INSERT INTO medicoespecialidades(medicoid, especialidadeid) VALUES('$request->Nidmedico', '$request->Nespid')"));
          }
          
          return response()->json($request);
        }
    }

    /**
     * Show the specified resource from storage.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function showDestroy(Request $request)
    {
        if($request->ajax()){

          $medico = Medico::find($request->id);

          return response()->json($medico);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
          $medico = Medico::find($request->Nid);
          $medEsp = DB::select(DB::raw("DELETE FROM medicoespecialidades WHERE medicoid = '$request->Nid'"));
          $medico->delete();

          return response()->json($request->Nid);
        }
    }
}
