@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-xs-12">
		<h3>Lista de Pedidos <a href="pedido/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('ventas.pedido.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				
				<th>Fecha</th>
				<th>Cliente</th>
				<th>Comentarios</th>
				<th>Estado</th>
				<th>Opciones</th>

				
			</thead>
			@foreach ($pedidos as $ven)
			<tr>
				
				<td>{{ $ven->fecha_hora }}</td>
				<td>{{ $ven->nombre}}</td>
				<td>{{ $ven->observacion}}</td>
				<td>{{ $ven->estado}}</td>
			
				<td><a href="{{ URL::action('PedidoController@show',$ven->idpedido) }}"><button class="btn btn-Primary">Detalles</button></a>
				<a href="" data-target="#modal-delete-{{ $ven->idpedido }}" data-toggle="modal"><button class="btn btn-danger">Terminar</button></a></td>

			</tr>

			@include('ventas.pedido.modal')
			@endforeach	
			<tfoot>
			
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			
			</tfoot>
			</table>
		</div>
		{{ $pedidos ->render() }}
	</div>
</div>
@endsection