<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {

    	$query = DB::select("select * 
    						 from pacientes
    						");


    	return response()->json($query);
    }
}
