<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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

    public function consultas() {

    	return $this->hasMany('App\Consulta', 'pacienteid');
    }

    public function convenio() {

    	return $this->hasMany('App\Convenio', 'pacienteid');
    }

    public function telefones() {

    	return $this->hasMany('App\Telefone', 'pacienteid');
    }
}
