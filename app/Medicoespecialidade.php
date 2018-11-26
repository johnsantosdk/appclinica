<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicoespecialidade extends Model
{
    protected $fillable = [
    	'medicoid',
    	'especialidadeid',
    ];

    //protected $primaryKey = 'medicoid';
    //protected $primaryKey = 'especialidadeid';

    public function medico(){

    	return $this->belongsTo('App\Meidco', 'medicoid');
    }

    public function especialidade() {

    	return $this->belongsTo('App\Especialidade', 'especialidadeid');
    }

}
