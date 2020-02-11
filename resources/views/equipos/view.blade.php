@extends('layouts.app')

@section('content')
	<div class="container">	    
	    <div class="row justify-content-center">
	        <div class="col">
	        	<div class="card">
	                <div class="card-header"><h3 class="title">{{ $equipo->nombre }}</h3></div>
	                <div class="card-body">
	                	@if(session('message'))
							<div class="alert alert-success">
								{{ session('message') }}
							</div>	
						@endif
	                	<fieldset class="border p-2">
			                <legend>Actualizar</legend>
			                <form action="{{ route('update_equipo') }}" method="POST">
			                  @csrf
							  <div class="row">
							    <div class="col-md-6">
							      <label for="nombre">Nombre del Equipo:</label>
				                  <input type="text" name="nombre" value="{{ $equipo->nombre }}" class="form-control" style="text-transform:uppercase;" required>
							      @if ($errors->has('nombre'))
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('nombre') }}</strong>
	                                    </span>
	                              @endif	
							    </div>
							    <div class="col-md-6">
							      <label for="categoria">Categoria:</label>
							      <input type="text" class="form-control" disabled value="{{ $equipo->categoria }}">
							    </div>
							  </div>
							  <div class="row">
								  <input type="hidden" value="{{ $equipo->id }}" name="id">
								  <input type="hidden" value="{{ $equipo->categoria }}" name="categoria">
								  <div class="col my-3">
								  		<?php if($equipo->estado == 'Activo'): ?><label> Deshabilitar</label><?php else: ?>Habilitar<?php endif; ?>
								    	
								    	<input id="accept" class="check" name="estado" <?php if($equipo->estado == 'Activo'): ?> checked <?php endif; ?> data-toggle="toggle" data-size="sm" type="checkbox"></td>
				                   		<button type="submit" class="btn btn-success mx-3">Actualizar</button>
			                   	  </div>
		                   	  </div> 	
							</form>
						</fieldset>
						
						<br><hr>

						<h3>Participacion en Torneos</h3>
						<br>
						<div class="table-responsive">
			                <table class="table text-center">
			                	<thead class="table-secondary">
			                		<th>Torneo</th>
			                		<th>Puesto</th>
			                		<th>Pts</th>
			                		<th>PJ</th>
			                		<th>PG</th>
			                		<th>PE</th>
			                		<th>PP</th>
			                		<th>GF</th>
			                		<th>GC</th>
			                		<th>Dif</th>
			                	</thead>
			                    <tbody id="tbody">
			                    
			                    	<tr>
			                    		<td>Clausura 2019</td>
			                    		<td>1°</td>
			                    		<td>48</td>
			                    		<td>20</td>
			                    		<td>10</td>
			                    		<td>10</td>
			                    		<td>0</td>
			                    		<td>56</td>
			                    		<td>10</td>
			                    		<td>+46</td>
			                    	</tr>
			                    	<tr>
			                    		<td>Apertura 2019</td>
			                    		<td>1°</td>
			                    		<td>48</td>
			                    		<td>20</td>
			                    		<td>10</td>
			                    		<td>10</td>
			                    		<td>0</td>
			                    		<td>56</td>
			                    		<td>10</td>
			                    		<td>+46</td>
			                    	</tr>
			                    
			                    </tbody>
			                </table>
			                
			            </div>    
		                
					</div>
	            </div>
	        </div>
	    </div>
	</div>

@endsection
