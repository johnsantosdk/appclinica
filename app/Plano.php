<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Convenios;
class Plano extends Model
{

	protected $fillable = [
        'idplano',
        'nome',
        'status',
    ];

    protected $primaryKey = 'idplano';

    public function convenios() {

    	return $this->hasMany('App\Convenios', 'planoid');
    }
}
