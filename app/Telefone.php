<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paciente;

class Telefone extends Model
{
    protected $fillable = [
        'tipo',
        'numero',
        'pacienteid'
    ];


    //protected $foreignKey = 'pacienteid';

    public function paciente() {

    	return $this->belongsTo('App\Paciente');
    }
}
