@extends('layouts.app')

@section('title', 'Registro de Consulta')

@section('content')

<div class="container">

	<div class='row'>
		<div class="col-sm-10">
			<form action="{{ route('paciente.show') }}" method="get">
				{{ csrf_field() }}
			{{--<div class="form-group">
					<label for="Inome">Nome:</label>
					<input type="text" id="Inome" name="Nnome" class="form-control">
				</div>

				<div class="form-group">
					<label for="Inasc">Data de nascimento:</label>
					<input type="date" id="Inasc" name="Nnasc" class="form-control">
				</div>  --}}

				<div class="form-group">
					<label for="Icpf">CPF:</label>
					<input type="text" id="Icpf" name="Ncpf" class="form-control">
				</div>
				</h>
				{{--<div class="form-group">
					<label for="IdAg">Data de Agendamento</label>
					<input type="date" id="IdAg" name="NdAg" class="form-control">
				</div>--}}
				<button type="submit" class="btn btn-primary">Buscar</button>
			</form>
			<input name="_method" type="hidden" value="PATCH">
		</div>
	</div>

</div>
@endsection

@section('script')
	


@endsection