<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
    	$telR = '(29)8877-6655';
        $id = 3;

            //DB::select(DB::raw("UPDATE pacientes SET nome = '$nome', sexo = '$sexo', nascimento = '$nasc', cpf = '$cpf', email = '$email' WHERE idpaciente = '$id' "));
            if(isset($telR)){
                $phoneR = DB::select(DB::raw("SELECT idtelefone, numero FROM telefones WHERE ((pacienteid = '$id') AND (tipo = 'RES'))"));
                foreach($phoneR as $pR){}
                if(isset($pR->idtelefone, $pR->numero)){
                    if($pR->numero != $telR){
                        $telefoneR = DB::table('telefones')
                                       ->where('idtelefone', $pR->idtelefone)
                                       ->update(['numero' => $telR]);
                    }
                }if(isset($pR->idtelefone) == null){
                    $telefoneR = new Telefone;
                    $telefoneR->tipo = 'RES';
                    $telefoneR->numero = $telR;
                    $telefoneR->pacienteid = $id;
                    $telefoneR->save();
                }
            }

    	return response()->json(isset($pR->idtelefone, $pR->numero) && ($pR->numero == $telR));
        //return response()->json($pR->numero);
    }
}
