<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidade;

class AgendaController extends Controller
{
    public function index()
    {
    	return view('agenda.index');
    }

    public function create()
    {
    	$especialidades = Especialidade::all();

    	return view('agenda.create', compact('especialidades'));
    }
}
