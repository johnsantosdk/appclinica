<?php

namespace App\Http\Controllers;

use App\Plano;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PlanoRequest;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plano.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $planos = Plano::orderBy('nome')->paginate(10);

        return view('plano.create', compact('planos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanoRequest $request)
    {
        if($request->all()){
            $plano = Plano::create([
                'nome'          => mb_convert_case($request->input('Nnome'), MB_CASE_TITLE,"UTF-8"),
                'status'  => $request->input('Nstatus'),
            ]);

            Session::flash('flash_message', [
                'msg' => "Plano cadastrado com SUCESSO!",
                'class'  => "alert-success"
            ]);

            return redirect()->back();
        }else
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function show(Plano $plano)
    {
        return view('plano.create');
    }

    public function list()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function edit(Plano $plano)
    {
        //
    }

    public function showPlano(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $planos = DB::select(DB::raw("SELECT idplano, nome, status FROM planos WHERE idplano = '$id'"));
            foreach($planos as $plano){}
            return response()->json($plano);
        }
    }

    public function editPlano(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $planos = DB::select(DB::raw("SELECT idplano, nome, status FROM planos WHERE idplano = '$id'"));
            foreach($planos as $plano){}
            return response()->json($plano);
        }

        //return Response($plano);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plano $plano)
    {
        //
    }

    public function updatePlano(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->input('Nid');
            $status = $request->input('Nstatus');
            DB::select(DB::raw("UPDATE planos SET status = '$status' WHERE idplano = '$id'"));

            return response($request);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function destroyPlano(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->input('Nid');
            DB::select(DB::raw("DELETE FROM planos WHERE idplano = '$id'"));

            Session::flash('flash_message', [
                'msg' => "O plano foi deletado com SUCESSO",
                'class' => "alert-success"
            ]);
        }

    }
}
