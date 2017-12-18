


	
	<table class="table table-hover" >
		<tr>
			<td><strong>Foto</strong></td>
			<td><strong>Nombre</strong></td>
			<td><strong>Precio unitario</strong></td>
			<td><strong>Cantidad</strong></td>
			<td><strong>Precio total</strong></td>
		</tr>

		@foreach ($productos as $p)
			<tr>
				<td>
					<img src="{{ '/'.$p->foto }}">
				</td>
				<td>
					<label>{{ $p->nombre }}</label>
				</td>
				<td>
					<label>{{ $p->precio_unitario }}</label>
				</td>
				<td>
					<label>{{ $p->cantidad }}</label>
				</td>
				<td>
					<label>{{$p->precio_unitario*$p->cantidad}}</label>
				</td>
			</tr>
		@endforeach
	</table>

