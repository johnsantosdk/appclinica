<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paciente;

class Telefone extends Model
{
    protected $fillable = [
        'idtelefone',
        'tipo',
        'numero',
        'pacienteid',
    ];

    protected $primaryKey = 'idtelefone';

    public function paciente() {

    	return $this->belongsTo('App\Paciente');
    }
}
