<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
    	$numero = '(98)98877-6655';

/**        $telIdR = DB::table('telefones')
        			->select('idtelefone')
        			->whereColumn([
                                  ['pacienteid', '=', 1],
                                  ['numero', '=', '(98)98877-6655']
                                  ])->first();**/

    	$query = DB::select(DB::raw("select idtelefone, numero from telefones where (pacienteid = 1) and (tipo = 'CEL')"));

		$arr = array(['nome' => 'Airton', 'sexo' => 'masculino']);
    	
    	$obj = DB::select('call getidtelefone(?,?)', array(1,'(98)98877-6655'));
    	
    	$bool = 'Nao Passou por dentro do if';
    	if(isset($query[0]->idtelefone)){
    		$bool = 'Entrou dentro do if';
    	}

    	$bool2 = 'Nao Passou por dentro do if';
    	if(isset($query[0]->idtelefone, $query[0]->numero)){
    		if($query[0]->numero == $numero){
    			$bool2 = 'Passou por dentro do if';
    		}
    	}
        foreach ($query as $q) {
            
        }
        $i = count($query);

                $convenio = DB::select(DB::raw("select idconvenio, matricula, planoid from convenios where pacienteid = '50'"));
                foreach($convenio as $conv){}
                

    	return response()->json(isset($conv->idconvenio) == null );
    }
}
