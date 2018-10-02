@extends('layouts.app')

@section('title', 'Marcação de Consulta')

@section('content')

<div class="container">

		<div class="row">
		  	<!--bloco pincipal-->
		    <div class="col-sm-6">
		      	<h3>Painel de Consulta</h3>
				<a href="{{ route('consulta.create') }}"><button type="button" class="btn btn-primary">Fazer Agendamento</button></a>
		    </div>
			<!--bloco secundário, possível calendário de consultas-->
		    <div class="col-sm-4">
		      	<h3>Column 2</h3>
		      	<p>Lorem ipsum dolor..</p>
		      	<p>Ut enim ad..</p>
		    </div>
  		</div>
</div>

@endsection