<div id="tabla">
	<h4 class="my-3">Tabla de Posiciones</h4><hr>
	@if($tabla != '')	
	<div class="table-responsive">
	    <table class="table text-center">
	       	<thead class="table-secondary">
	       		<th>Posiciones</th>
	       		<th>Equipo</th>
	       		<th>PJ</th>
	       		<th>PG</th>
	       		<th>PE</th>
	       		<th>PP</th>
	       		<th>GF</th>
	       		<th>GC</th>
	       		<th>Dif</th>
	       		<th>Pts</th>
	       	</thead>
	        <tbody id="tbody">
	        	<?php $p=1; ?>
	           	@foreach($tabla as $posicion)
	           	<tr>
	          		<td>{{$p}}°</td>
	           		<td>{{ $posicion->equipo->nombre }}</td>
	          		<td>{{ $posicion->jugados }}</td>
	           		<td>{{ $posicion->ganados }}</td>
	           		<td>{{ $posicion->empatados }}</td>
	          		<td>{{ $posicion->perdidos }}</td>
	          		<td>{{ $posicion->gf }}</td>
	          		<td>{{ $posicion->gc }}</td>
	           		<td>{{ $posicion->dif }}</td>
	           		<td>{{ $posicion->puntos }}</td>
	           	</tr>
	           	<?php $p++; ?>
	           	@endforeach
	        </tbody>
	    </table>
	</div>
	@else
	<h5 class="text-danger">No se jugo ningun partido en este torneo</h5>	
	@endif
</div>
