<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    //
    protected $fillable = [
    	'idespecialidade',
    	'nome',
    	'cbo',
    ];

    protected $primaryKey = 'idespecialidade';

    public function medico() {

    	return $this->belongsToMany('App\Medico');
    }
}
