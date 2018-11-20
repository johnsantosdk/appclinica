<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atendente extends Model
{
    //

    protected $fillable [
    	'idatendente',
    	'nome',
    	'matricula',
    ];

    protected $primaryKey = 'idatendente';

    public function consulta() {


    	return $this->hasMany('App\Consultas');
    }
}
