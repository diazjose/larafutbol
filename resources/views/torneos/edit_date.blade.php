@extends('layouts.app')

@section('content')
<div class="container">
	<div class="table-responsive">
		<br>
		<table class="table text-center">
			<thead class="table-secondary">
		   		<th colspan="5">Fecha N° {{$fecha}}</th>		
			</thead>
			<tbody>
				@foreach($partidos as $partido)
				<tr>
					<?php $count=0; ?>
					@foreach($partido->equipos as $equipo)
						@if($equipo->equipo_id == 1)
							<?php $part = $equipo->partido_id ?>
						@else
							@if($equipo->partido_id != $part)
								@if($count == 0)
								<td>{{$equipo->equipo->nombre}}</td>
								<td><input type="number" class="text-center" value="0"></td>
								<?php $count=1; ?>
								@else
								<td>VS</td>
								<td><input type="number" class="text-center" value="0"></td>
								<td>{{$equipo->equipo->nombre}}</td>
								<?php $count=1; ?>
								@endif
							@endif	
						@endif
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div>
		<a href="#" class="btn btn-success">Cargar Resultado</a>
	</div>
</div>	
@endsection