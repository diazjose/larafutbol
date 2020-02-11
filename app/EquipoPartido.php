<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipoPartido extends Model
{
    protected $table = 'equipo_part';

    protected $fillable = [
    	'partido_id', 'equipo_id', 'goles', 'resultado',
    ]; 

    public function partido(){
    	return 	$this->belongsTo('App\Partido', 'partido_id');
    }

    public function equipo(){
    	return $this->belongsTo('App\Equipo', 'equipo_id');
    }
}
