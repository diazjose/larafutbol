<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Equipo;

class EquiposController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($categoria=''){
    	if ($categoria == 'Pre-Veteranos') {
    		$equipos = Equipo::where('categoria', $categoria)->orderBy('id','desc')->paginate(10);	
    	}else{
    		$equipos = Equipo::where('categoria', $categoria)->orderBy('id','desc')->paginate(10);
    	}    	
    	return view('equipos.equipos', ['equipos' => $equipos,
    									'categoria' => $categoria
    		]);
    }

    public function view($id){
        $equipo = Equipo::find($id);
        return view('equipos.view', ['equipo' => $equipo]);   
    }

    public function create(Request $request){

    	$nombre = strtoupper($request->input('nombre'));
    	$categoria = $request->input('categoria');
    	$estado = $request->input('estado');
        
        $validate = $this->validate($request, [
    			'nombre' => ['required', 'string','max:255',
    						  Rule::unique("equipos")->where('categoria',$categoria)
    						]  
    		]);
    	$equipo = new Equipo;
    	$equipo->nombre = $nombre;
    	$equipo->categoria = $categoria;
    	if ($estado	== 'on') {
    		$equipo->estado = 'Activo';	
    	}else{
			$equipo->estado = 'DesActivo';
    	}    	
    	$equipo->save();
    	return redirect()->route('view_equipos', [$categoria])
    					 ->with(['message' => 'Equipo cargado correctamente']);
    }

    public function update(Request $request){
        $nombre = strtoupper($request->input('nombre'));
        $categoria = $request->input('categoria');
        $estado = $request->input('estado');
        $id = $request->input('id');
        $equipo = Equipo::find($id);
        
        $validate = $this->validate($request, [
                'nombre' => ['required', 'string','max:255',
                              Rule::unique("equipos")->where('categoria',$categoria)
                            ]  
            ]);
        $equipo->nombre = $nombre;
        if ($estado == NULL) {
            $equipo->estado = 'DesActivo'; 
        }else{
            $equipo->estado = 'Activo';
        }       
        $equipo->update();

        return redirect()->route('view_equipo', [$id])
                         ->with(['message' => 'Equipo Actualizado correctamente']);
    }

    public function search(Request $request){
    	
    	$equipos = Equipo::where('categoria', $request->input('viene'))->orderBy('id', 'DESC')->nombre($request->input('buscar'))->paginate(10);
    	
    	$html = '';
		foreach ($equipos as $equipo) {
			$html.= '<tr>'; 
				$html .= '<td>'.$equipo->nombre.'</td>';
				$html .= '<td>'.$equipo->created_at->format('d/m/Y').'</td>';
				$html .= '<td>'.$equipo->estado.'</td>';
				$html .= '<td><a href="http://localhost/larafutbol/public/equipos/ver/'.$equipo->id.'" class="btn btn-info">Ver</a></td>';
			$html .= '</tr>';	 
        }    
        return response()->json($html);	
    }
}
