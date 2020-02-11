<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posiciones extends Model
{
    protected $table = 'posiciones';

 	protected $fillable = [
    	'torneo_id', 'equipo_id', 'jugados', 'perdidos', 'empatados', 'gf', 'gc', 'dif', 'puntos',
    ]; 

    public function equipo(){
    	return 	$this->belongsTo('App\Equipo', 'equipo_id');
    }
}