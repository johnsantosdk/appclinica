<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
    	 'idagenda',
    	 'sunday',
		 'sunday_start_time',
		 'sunday_end_time',
		 'monday',
		 'monday_start_time',
		 'monday_end_time',
		 'tuesday',
		 'tuesday_start_time',
		 'tuesday_end_time',
		 'wednesday',
		 'wednesday_start_tim',
		 'wednesday_end_time',
		 'thursday',
		 'thursday_start_time',
		 'thursday_end_time',
		 'friday',
		 'friday_start_time',
		 'friday_end_time',
		 'saturday',
		 'saturday_start_time',
		 'saturday_end_time',
		 'current',
		 'medicoid',
    ];

    protected $primaryKey = 'idagenda';

    public function medico(){
    	return $this->belongsTo('App\Medico');
    }
}
