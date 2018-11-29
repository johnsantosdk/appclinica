<?php

namespace App\Http\Controllers;

use App\Especialidade;
use App\Medicos_Especialidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EspecialidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('especialidade.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades = Especialidade::paginate(10);

        return view('especialidade.create', compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request)){
            $especialidade = Especialidade::create([
                'nome' => $request->input('Nnome'),
                'cbo' => $request->input('Ncbo'),
            ]);

            Session::flash('flash_message', [
                'msg' => "Especialidade cadastrada,
                  com SUCESSO!",
                'class'  => "alert-success"
            ]);

            return redirect()->route('especialidade.create');
        }

        return redirect()->route('especialidade.create')->withInput(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //return response()->json($request->id);
        if($request->ajax()){

            $especialidade = Especialidade::find($request->id);

            return response()->json($especialidade);
        }

        //return response()->json(500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Especialidade $especialidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->ajax()){

            $id = $request->input('Nid');
            $nome = $request->input('Nnome');
            $cbo = $request->input('Ncbo');

            $especialidade = Especialidade::find($id);

            if(isset($nome) && ($nome != $especialidade->nome)){
                $especialidade->nome = $nome;
            }if(isset($cbo) && ($cbo != $especialidade->cbo)){
                $especialidade->cbo = $cbo;
            }

            $especialidade->save();

            return response()->json($especialidade);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function showDestroy(Request $request)
    {
        if($request->ajax()){

            $especialidade = Especialidade::find($request->id);

            return response()->json($especialidade);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('Nid');

            $especialidade = Especialidade::find($id);
            $especialidade->delete();

            return response()->json($id);
        }
    }
}
