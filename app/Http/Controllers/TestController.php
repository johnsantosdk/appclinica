<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {

    	$query = DB::select("select nome 
    							from pacientes
    							where id = 1
    						   ");


    	return response()->json($query);
    }
}
