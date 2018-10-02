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
        'data_nascimento',
        'cpf',
        'email',
        'atendente_id'
    ];

    public function consulta() {

    	return $this->hasMany('App\Consulta');
    }

    public function convenio() {

    	return $this->hasMany('App\Convenio');
    }

    public function telefone() {

    	return $this->hasMany('App\Telefone');
    }
}
