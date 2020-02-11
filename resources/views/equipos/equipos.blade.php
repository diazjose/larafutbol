@extends('layouts.app')

@section('content')
	<div class="container">
	    
	    <div class="row justify-content-center">
	        <div class="col">
	        	<div class="card">
	                <div class="card-header"><h3 class="title">Equipos de {{ $categoria }}</h3></div>
	                <div class="card-body">
	                <div class="row">
					    <div class="col-md-5 my-3">
					      <input id="buscar" type="text" class="form-control" style="text-transform:uppercase;" placeholder="Buscar.."><br>
					    </div>
					    <div class="col-md-5"></div>
					    <div class="col-md-2 my-3">
					      <button type="button" class="btn btn-success btn-sm-block" data-toggle="modal" data-target="#equipoModal">
					        <i class="fas fa-plus-circle"></i> <strong>Nuevo Equipo</strong> 
					      </button>
					    </div>    
					</div>
					@if(session('message'))
					<div class="alert alert-success">
						{{ session('message') }}
					</div>	
					@endif
	                @if($equipos)
	                <div class="table-responsive">
		                <table class="table text-center">
		                	<thead class="thead-dark">
		                		<th>Nombre</th>
		                		<th>Fecha de Ingreso</th>
		                		<th>Estado</th>
		                		<th>Accion</th>
		                	</thead>
		                    <tbody id="tbody">
		                    @foreach($equipos as $equipo)
		                    	<tr>
		                    		<td>{{ $equipo->nombre }}</td>
		                    		<td>{{ $equipo->created_at->format('d/d/Y') }}</td>
		                    		<td>{{ $equipo->estado }}</td>
		                    		<td><a href="{{ route('view_equipo', $equipo->id) }}" class="btn btn-info">Ver</a></td>
		                    	</tr>
		                    @endforeach
		                    </tbody>
		                </table>
		                {{ $equipos->links() }}
		            </div>    
	                @endif
	                </div>
	            </div>
	            <div style="display: none">
	            	<form action="{{ route('search_equipos') }}" method="POST" id="form-search">
	            		@csrf
	            		<input type="text" name="buscar" value="" id="form_buscar" />
	            		<input type="hidden" name="viene" value="" id="viene">
	            	</form>
	            </div>
	        </div>
	    </div>


	    <div class="modal fade" id="equipoModal">
	      <div class="modal-dialog">
	        <div class="modal-content">
	        
	          <!-- Modal Header -->
	          <div class="modal-header table-dark">
	            <h4 class="modal-title title">Equipo Nuevo</h4>
	            <button type="button" class="close text-white" data-dismiss="modal">×</button>
	          </div>
	          
	          <!-- Modal body -->
	          <div class="modal-body">	              
	              <form action="{{ route('new_equipos') }}" method="POST">
	              	  @csrf
	                  <div class="form-group">
	                    <label for="nombre">Nombre del Equipo:</label>
	                    <input type="text" name="nombre" class="form-control" style="text-transform:uppercase;" required>
	                  </div>
	                  <div class="form-group">
	                    <label for="categoria">Categoria</label>
	                    <input type="text" class="form-control" id="categoria" name="categoria" value="{{ $categoria }}">
	                  </div>
	                   <input id="accept" class="check" name="estado" data-toggle="toggle" data-size="sm" type="checkbox"></td>
	                   <label> Habilitar</label>   
	                  <!--
	                  <div>
	                 	   <input type="checkbox" class="custom-control-input" id="accept" name="estado">
	                       <label class="custom-control-label" for="accept">Habilitar</label>
	                  </div>
	                  --> 	 
	                  <hr>
	                  <div class="row justify-content-end mx-4">
		                  <button type="button" class="btn btn-danger mx-2" data-dismiss="modal">Cerrar</button>
		            	  <button type="submit" class="btn btn-primary">Guardar</button>
	          	  	  </div>	
	          	  </form>	
	          </div>	          
	        </div>
	      </div>
	    </div>
	</div>
@endsection
@section('script')
    <script src="{{ asset('js/equipos.js') }}"></script>
@endsection
