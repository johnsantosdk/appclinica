@extends('layouts.app')

@section('title', 'Área dos Médicos')

@section('content')

<div class="container">
	
	<div class="row">
		<div class='col-sm-10'>
			<a href="{{ route('medico.create') }}"><button type="button" class="btn btn-primary">Registrar Médico</button></a>
		</div>
	</div>
	
</div>

@endsection