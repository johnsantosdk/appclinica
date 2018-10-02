@extends('layouts.app')

@section('title', 'Registro de Pacientes')

@section('content')

<div class="container">
	
	<div class="row">
		<div class='col-sm-10'>
			<a href="{{ route('paciente.create') }}"><button type="button" class="btn btn-primary">Registrar Paciente</button></a>
		</div>
	</div>

</div>

@endsection