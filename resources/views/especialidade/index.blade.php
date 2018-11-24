@extends('layouts.app')

@section('title', 'Especialidades')

@section('content')

<div class="container">
	
	<div class="row">
		<div class='col-sm-10'>
			<a href="{{ route('especialidade.create') }}"><button type="button" class="btn btn-primary">Registrar Especialidade</button></a>
		</div>
	</div>

</div>

@endsection