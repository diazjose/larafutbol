<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partidos';

    protected $fillable = [
    	'torneo_id', 'numero_fecha', 'estado',
    ]; 

    public function equipos(){
    	return 	$this->hasMany('App\EquipoPartido');
    }
}
