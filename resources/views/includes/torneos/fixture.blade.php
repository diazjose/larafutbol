<div id="fixture">
	<h4 class="my-3">Fixture</h4><hr>
	@if($equipos)
	<div class="row">
		<div class="col-md-6">
			<a href="#" class="btn btn-primary btn-block my-1">Cargar 1° Fecha</a> 
		</div>
		<div class="col-md-6">
			<a href="#" class="btn btn-primary btn-block my-1">Cargar Equipos</a>
		</div>								
	</div>	
	
	<div id="cargar_fecha" class="justify-content-center">
		<form action="{{ route('fixture_torneo') }}" method="POST">
			@csrf
			<div class="table-responsive">
				<input type="hidden" value="{{$torneo->id}}" name="torneo">
				<input type="hidden" value="{{$torneo->cant_equipos}}" name="cant_equipos">
							
		        <table class="table text-center">
		           	<thead class="table-secondary">
		           		<th colspan="3">Fecha 1°</th>
		           	</thead>
		            <tbody id="tbody">
	            	<?php 
	            		$i=1;  
	            		$cantidad = $torneo->cant_equipos;
	            		$final = $cantidad/2;
	            	?>
	            	@if($cantidad%2!=0)
	            	<?php 
	           		$cantidad++; 
	           		$final = $cantidad/2;
	            	?>
		               	<tr>
		               		<td>
		               			<select class="sel form-control" name="equipo{{$i}}" required>
								    <option value='1'>Libre</option>
								</select>
								<input type="hidden" name="orden{{$i}}" value="{{$i}}">
		               		</td>
		               		<td>VS</td>
		              		<td>
			              		<?php $i++ ?>
		              			<select class="sel form-control" name="equipo{{$i}}" required>
								    <option>Selecciona</option>
									@foreach($equipos as $equipo)
								    <option value='{{ $equipo->id }}'>{{ $equipo->nombre }}</option>	    
									@endforeach                
								</select>
								<input type="hidden" name="orden{{$i}}" value="{{$i}}">
			           		</td>
			           	</tr>
			        @else
			           	<tr>
			           		<td>
			           			<select class="sel form-control" name="equipo{{$i}}" required>
								    <option>Selecciona</option>
									@foreach($equipos as $equipo)
								    <option value='{{ $equipo->id }}'>{{ $equipo->nombre }}</option>	    
									@endforeach
								</select>
								<input type="hidden" name="orden{{$i}}" value="{{$i}}">
			           		</td>
			           		<td>VS</td>
			           		<td>
			              		<?php $i++ ?>
			           			<select class="sel form-control" name="equipo{{$i}}" required>
								    <option>Selecciona</option>
									@foreach($equipos as $equipo)
								    <option value='{{ $equipo->id }}'>{{ $equipo->nombre }}</option>	    
									@endforeach                
								</select>
								<input type="hidden" name="orden{{$i}}" value="{{$i}}">
					   		</td>									              		
					   	</tr>
					@endif
					<?php 
					   	$i++;
					   	$final++
					?>
					   	@for($i; $i <= $final ; $i++)
					   	<tr>
					   		<td>
					   			<select class="sel form-control" name="equipo{{$i}}" required>
								   <option>Selecciona</option>
									@foreach($equipos as $equipo)
								    <option value='{{ $equipo->id }}'>{{ $equipo->nombre }}</option>	    
									@endforeach
								</select>
								<input type="hidden" name="orden{{$i}}" value="{{$i}}">
					   		</td>
					   		<td>VS</td>
					   		<td>
					   			<select class="sel form-control" name="equipo{{$e=$cantidad--}}" required>
								    <option>Selecciona</option>
									@foreach($equipos as $equipo)
								    <option value='{{ $equipo->id }}'>{{ $equipo->nombre }}</option>	    
									@endforeach                
								</select>
								<input type="hidden" name="orden{{$e}}" value="{{$e}}">
							</td>
						</tr>
						@endfor
					</tbody>
				</table>
				<div class="justify-content-center mx-5">
				   	<button type="submit" class="btn btn-success btn-block col-md-6">Generar Fixture</button>
				</div>
				     
			</div>
		</form>								    
	</div>
	
	<div id="cargar_equipos">
									
	</div>								
	@else
		@if($partidos)
			@for($i=1; $i <= $torneo->cant_equipos; $i++)
			<div class="table-responsive">
				<br>
			  	<table class="table text-center">
			   		<thead class="table-secondary">
			    		<th colspan="3">Fecha N° {{$i}}</th>		
			   		</thead>
			   		<tbody>
			   			@foreach($partidos[$i] as $partido)
						<tr>
						<?php $count=0; ?>
							@foreach($partido->equipos as $equipo)
							   			
				   				@if($count == 0)
				   				<td>{{$equipo->equipo->nombre}}</td>
				   				<?php $count=1; ?>
				   				@else
				   				<td>VS</td>
				   				<td>{{$equipo->equipo->nombre}}</td>
				   				<?php $count=1; ?>
				   				@endif
				
				   			@endforeach
						</tr>
			   			@endforeach
			  		</tbody>
			   	</table>
			</div>
			<div>
				<a href="{{ route('save_result', [$torneo->id, $i]) }}" class="btn btn-success">Cargar Resultado</a>
			</div>
			@endfor
		@endif
	@endif
</div>
