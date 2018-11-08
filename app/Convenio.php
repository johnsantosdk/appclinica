<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Consulta;
use App\Paciente;
use App\Planos;
class Convenio extends Model
{
    //

    protected $fillable = [
        'matricula',
        'pacienteid',
        'planoid'
    ];

    public function paciente() {

    	return $this->belongsTo('App\Paciente');
    }

    public function consulta() {

    	return $this->hasMany('App\Consulta', 'convenioid');
    }

    public function plano() {

    	return $this->belongsTo('App\Palno');
    }
}
