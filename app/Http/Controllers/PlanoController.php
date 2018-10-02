<?php

namespace App\Http\Controllers;

use App\Plano;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

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
    public function store(Request $request)
    {
        $plano = Plano::create([
            'nome'          => strtoupper($request->input('Nnome')),
            'status_plano'  => $request->input('Nstatus',1),
        ]);

        Session::flash('flash_message', [
            'msg' => "Plano cadastrado com SUCESSO!",
            'class'  => "alert-success"
        ]);

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
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plano $plano)
    {
        //
    }
}
