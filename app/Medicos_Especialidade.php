<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicos_Especialidade extends Model
{
    protected $fillable = [
    	'medicoid',
    	'especialidadeid',
    ];

    protected $primaryKey = [
    	'medicoid',
    	'especialidadeid',
    ];

    public function medico(){

    	return $this->belongsTo('App\Meidco', 'medicoid');
    }

    public function especialidade() {

    	return $this->belongsTo('App\Especialidade', 'especialidadeid');
    }

}
