@extends('layouts.app')

@section('title', 'Cadastro de Convênios')

@section('head')

@endsection

@section('content')

<div class="container">

	<div class='row'>
		<div class="col-sm-10">
			<form action="{{ action('ConvenioController@store') }}" method="POST">
				{{ csrf_field() }}
				<fieldset>
					<legend>Dados do Convênio</legend>
					<div class="form-group">
						<label for="Inome">Nome:</label>
						<input type="text" id="Inome" name="Nnome" class="form-control">
					</div>

				</fieldset>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		</div>
	</div>

</div>

@endsection

@section('script')
	


@endsection