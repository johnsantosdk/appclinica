<?php

namespace App\Http\Controllers;

use App\Atendente;
use Illuminate\Http\Request;

class AtendenteController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atendente  $atendente
     * @return \Illuminate\Http\Response
     */
    public function show(Atendente $atendente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atendente  $atendente
     * @return \Illuminate\Http\Response
     */
    public function edit(Atendente $atendente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atendente  $atendente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atendente $atendente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atendente  $atendente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atendente $atendente)
    {
        //
    }
}
