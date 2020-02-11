<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    protected $table = 'torneos';


    public function partidos(){
    	return $this->hasMany('App\Partido');
    }

}
