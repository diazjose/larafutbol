@extends('layouts.app')

@section('content')
	<div class="container">	    
	    <div class="row justify-content-center">
	        <div class="col-md-3 my-3">
				<div class="card">
					<div class="card-header">
					    <h3 class="title"><strong>MENU</strong></h3>
					</div>
					<div class="list-group">
					  <a href="#" id="ver_editar" class="list-group-item list-group-item-action active"><strong>ACTUALIZAR</strong></a>
					  <a href="#" id="ver_equipos" class="list-group-item list-group-item-action"><strong>VER EQUIPOS</strong></a>
					  <a href="#" id="ver_fixture" class="list-group-item list-group-item-action"><strong>VER FIXTURE</strong></a>
					  <a href="#" id="ver_tabla" class="list-group-item list-group-item-action"><strong>VER TABLA DE POSICIONES</strong></a>
					</div> 
				</div>			
			</div>
	        <div class="col my-3">
	        	<div class="card">
	                <div class="card-header"><h3 class="title">{{ $torneo->nombre }} {{ date('Y', strtotime($torneo->fecha_inicio)) }} {{ $torneo->categoria }} </h3></div>
	                <div class="card-body">
	                	<div id="actualizar">
		                	@if(session('message'))
								<div class="alert alert-success">
									{{ session('message') }}
								</div>	
							@endif
		                	<fieldset class="border p-2">
				                <legend>Actualizar</legend>
				                <form action="{{ route('update_torneo') }}" method="POST">
				                  @csrf
								  <div class="row">
								    <div class="col-md-6">
								      <label for="nombre">Nombre del Torneo:</label>
					                  <input type="text" name="nombre" value="{{ $torneo->nombre }}" class="form-control" style="text-transform:uppercase;" required>
								      @if ($errors->has('nombre'))
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('nombre') }}</strong>
		                                    </span>
		                              @endif	
								    </div>
								    <div class="col-md-6">
								      <label for="fecha_inicio">Fecha de Inicio:</label>
					                  <input type="date" name="fecha_inicio" value="{{ $torneo->fecha_inicio }}" class="form-control" style="text-transform:uppercase;" required>
								      @if ($errors->has('fecha_inicio'))
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('fecha_inicio') }}</strong>
		                                    </span>
		                              @endif	
								    </div>
								    <div class="col-md-6">
								      <label for="cant_equipos">Cantidad de Equipos:</label>
					                  <input type="number" name="cant_equipos" value="{{ $torneo->cant_equipos }}" class="form-control" style="text-transform:uppercase;" required>
								      @if ($errors->has('cant_equipos'))
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('cant_equipos') }}</strong>
		                                    </span>
		                              @endif	
								    </div>
								    <div class="col-md-6">
								      <label for="categoria">Categoria:</label>
								      <input type="text" class="form-control" disabled value="{{ $torneo->categoria }}">
								    </div>
								  </div>
								  <div class="row">
									  <input type="hidden" value="{{ $torneo->id }}" name="id">
									  <input type="hidden" value="{{ $torneo->categoria }}" name="categoria">
									  <div class="col my-3">
									  		<button type="submit" class="btn btn-success mx-3">Actualizar</button>
				                   	  </div>
			                   	  </div> 	
								</form>
							</fieldset>
						</div>
												
						@include('includes.torneos.fixture')
						@include('includes.torneos.tabla')

						
					</div>
	            <br>
	            </div>
	        </div>
	    </div>
	</div>

@endsection
@section('script')
    <script src="{{ asset('js/torneos.js') }}"></script>
@endsection
