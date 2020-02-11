<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Torneo;
use App\Equipo;
use App\Partido;
use App\EquipoPartido;
use App\Posiciones;


class TorneosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($categoria = ''){
    	if ($categoria == 'Pre-Veteranos') {
    		$torneos = Torneo::where('categoria', $categoria)->orderBy('id','desc')->paginate(10);	
    	}else{
    		$torneos = Torneo::where('categoria', $categoria)->orderBy('id','desc')->paginate(10);
    	}    	
    	return view('torneos.torneos', ['torneos' => $torneos,
    									'categoria' => $categoria
    		]);
    }

    public function create(Request $request){

    	$nombre = strtoupper($request->input('nombre'));
    	$categoria = $request->input('categoria');
    	$fecha_inicio = $request->input('fecha_inicio');
        $cant_equipos = $request->input('cant_equipos');
        /*
        $validate = $this->validate($request, [
    			'nombre' => ['required', 'string','max:255',
    						  Rule::unique("torneos")->where('fecha_inicio', '=', date('Y'))->where('categoria',$categoria)
    						]  
    		]);*/
    	$torneo = new Torneo;
    	$torneo->nombre = $nombre;
    	$torneo->categoria = $categoria;
    	$torneo->fecha_inicio = $fecha_inicio;
        $torneo->cant_equipos = $cant_equipos;
    	$torneo->save();
    	return redirect()->route('view_torneos', [$categoria])
                         ->with(['message' => 'Torneo cargado correctamente', 'status' => 'success']);
        /*
        if ($validate) {
            return redirect()->route('view_torneos', [$categoria])
                         ->with(['message' => 'El Torneo con ese nombre ya existe en ese año', 'status' => 'error']);   
        }else{
            return redirect()->route('view_torneos', [$categoria])
                         ->with(['message' => 'Torneo cargado correctamente', 'status' => 'success']);
        }*/
        
    }

    public function update(Request $request){
        $nombre = strtoupper($request->input('nombre'));
        $categoria = $request->input('categoria');
        $fecha_inicio = $request->input('fecha_inicio');
        $cant_equipos = $request->input('cant_equipos');
        $id = $request->input('id');
        $torneo = Torneo::find($id);
        
        $validate = $this->validate($request, [
                'nombre' => ['required', 'string','max:255',
                              Rule::unique("torneos")->where('categoria',$categoria)
                            ]  
            ]);
        $torneo->nombre = $nombre;
        $torneo->categoria = $categoria;
        $torneo->fecha_inicio = $fecha_inicio;
        $torneo->cant_equipos = $cant_equipos;
               
        $torneo->update();

        return redirect()->route('view_torneo', [$id])
                         ->with(['message' => 'Torneo Actualizado correctamente']);
    }

    public function view($id){
        $torneo = Torneo::find($id);
        $tabla = Posiciones::where('torneo_id', $id)->get();
        //var_dump($tabla);
        //die();
        if (count($torneo->partidos)>0) {
            for ($i=1; $i <= $torneo->cant_equipos; $i++) { 
                $partidos[$i] = Partido::where('numero_fecha', $i)->where('torneo_id', $id)->get();
            }
            $jugados = Partido::where('torneo_id', $id)->where('estado', 1)->get();
            if (count($jugados)>0) {
                $tabla = Posiciones::where('torneo_id', $id)
                                        ->orderBy('puntos', 'DESC')
                                        ->orderBy('dif', 'DESC')
                                        ->get();
                if (count($tabla)==0) {
                    $tabla = '';
                }
                return view('torneos.view', [
                                'torneo' => $torneo, 
                                'equipos' => '', 
                                'partidos' => $partidos, 
                                'tabla' => $tabla
                            ]);    
            }else{
                return view('torneos.view', ['torneo' => $torneo, 'equipos' => '', 'partidos' => $partidos, 'tabla' => '']);
            }
            
        }else{
            $categoria = $torneo->categoria;
            $equipos = Equipo::where('categoria', $categoria)->where('estado', 'Activo')->orderBy('nombre')->get();
            return view('torneos.view', ['torneo' => $torneo, 'equipos' => $equipos, 'partidos' => '', 'tabla' => '']);
        }           
    }

    public function create_fixture(Request $request){

        $torneo = $request->input('torneo');
        if ($request->input('cant_equipos')%2==0) {
            $cant = $request->input('cant_equipos');
        }else{
            $cant = $request->input('cant_equipos')+1;
        }
        $cant_fechas = $cant - 1;
        $cant_equipos = $cant/2;
        $cant_equipos1 = $cant_equipos + 1;
        $e = 2;
        $o = 2;

        for ($i = 0; $i < $cant_equipos; $i++) { 
            $equipo[$o] = $request->input('equipo'.$e);
            $e++;
            $o++;
        }

        $o = 1;
        for ($i=$cant ; $i > $cant_equipos1 ; $i-- ) {
            $equipo1[$i] = $request->input('equipo'.$i);
            $e++;
            $o++;
        }  
        $one = $request->input('equipo1');
        $existe = 0;
        $existe1 = 0;
        var_dump($equipo);
        echo "<br>";
        var_dump($equipo1); 
        for ($i=1; $i <= $cant_fechas; $i++) { 
            foreach ($equipo as $e1) {    
                $partidos = Partido::where('torneo_id', $torneo)->where('numero_fecha', $i)->get();
                if (count($partidos)>0) { 
                    foreach ($equipo1 as $e2) {
                        $partidos = Partido::where('torneo_id', $torneo)->where('numero_fecha', $i)->get();
                        foreach ($partidos as $partido) {
                            if (count($partido->equipos)>0) {
                                foreach ($partido->equipos as $e_p) {
                                    if ($e_p->equipo_id == $e1) {
                                        $existe = 1;      
                                    }
                                    if ($e_p->equipo_id == $e2) {
                                        $existe1 = 1;      
                                    }   
                                }
                            }                    
                        }
                        if ($existe == 0 and $existe1 == 0) {
                            $Partido = new Partido;
                            $Partido->torneo_id = $torneo;
                            $Partido->numero_fecha = $i;
                            $Partido->estado = 0;
                            $Partido->save();    
                            $EquipoPartido = new EquipoPartido;
                            $EquipoPartido->partido_id = $Partido->id;
                            $EquipoPartido->equipo_id = $e1;
                            $EquipoPartido->save();
                            $EquipoPartido = new EquipoPartido;
                            $EquipoPartido->partido_id = $Partido->id;
                            $EquipoPartido->equipo_id = $e2;
                            $EquipoPartido->save();
                        }
                        $existe = 0;
                        $existe1 = 0;
                    } 
                }else{
                    $Partido = new Partido;
                    $Partido->torneo_id = $torneo;
                    $Partido->numero_fecha = $i;
                    $Partido->estado = 0;
                    $Partido->save();
                    $EquipoPartido = new EquipoPartido;
                    $EquipoPartido->partido_id = $Partido->id;
                    $EquipoPartido->equipo_id = $one;
                    $EquipoPartido->save();
                    $EquipoPartido = new EquipoPartido;
                    $EquipoPartido->partido_id = $Partido->id;
                    $EquipoPartido->equipo_id = $e1;
                    $EquipoPartido->save();
                }                
            }
            $ultimo = array_pop($equipo);
            $insertar_ultimo = array_push($equipo1, $ultimo); 
            $primero = array_shift($equipo1);
            $insertar_principio = array_unshift($equipo, $primero);
        }  
        return redirect()->route('view_torneo', [$torneo]);
    }

    public function save_result($torneo, $fecha){
        $partidos = Partido::where('numero_fecha', $fecha)->where('torneo_id', $torneo)->get();
        
        return view('torneos.edit_date', ['partidos' => $partidos, 'fecha' => $fecha]);
    }
}