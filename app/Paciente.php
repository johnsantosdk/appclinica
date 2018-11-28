<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Consulta;
use App\Convenio;
use App\Telefone;

class Paciente extends Model
{
    //

    protected $fillable = [
        'nome',
        'sexo',
        'nascimento',
        'cpf',
        'email',
    ];
    
    protected $primaryKey = 'idpaciente';

    public function consultas() {

    	return $this->hasMany('App\Consulta', 'pacienteid');
    }

    public function convenio() {

    	return $this->hasMany('App\Convenio', 'pacienteid');
    }

    public function telefones() {

    	return $this->hasMany('App\Telefone', 'pacienteid');
    }

    public static function selectByAnyAttribute($cpf)
    {
        return DB::select(DB::raw("SELECT idpaciente, sexo, nascimento, cpf, email FROM pacientes WHERE cpf = '$cpf'"));
    }

}
