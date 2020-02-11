<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
	protected $table = 'equipos';


	public function partidos(){
		return $this->hasMany('App\EquipoPartido');
	}

	public function scopeNombre($query, $nombre){
		if ($nombre) 
			return $query->where("nombre", "LIKE", "%$nombre%");
	}

}
