<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Convenios;
class Plano extends Model
{

	protected $fillable = [
        'idplano',
        'nome',
        'status'
    ];

    public function caonvenios() {

    	return $this->hasMany('App\Convenios', 'planoid');
    }
}
