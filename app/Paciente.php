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
        'atendente_id',
        'convenio_id'
    ];

    public function consultas() {

    	return $this->hasMany('App\Consulta');
    }

    public function convenio() {

    	return $this->hasMany('App\Convenio');
    }

    public function telefones() {

    	return $this->hasMany('App\Telefone');
    }
}
