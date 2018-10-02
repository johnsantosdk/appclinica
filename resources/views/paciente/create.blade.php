@extends('layouts.app')

@section('title', 'Registro de Paciente')

@section('content')

<div class="container">

	<div class='row'>
		<div class="col-sm-10">
			<form action="{{ action('PacienteController@store') }}" method="POST">
				{{ csrf_field() }}
				<fieldset>
					<legend>Dados do Paciente</legend>
					<div class="form-group">
						<label for="Inome">Nome:</label>
						<input type="text" id="Inome" name="Nnome" class="form-control">
					</div>

					<div class="form-group">
						<label for="Inasc">Nasc.:</label>
						<input type="date" id="Inasc" name="Nnasc" class="form-control">
					</div>

					<div class="form-group">
						<label for="Icpf">CPF:</label>
						<input type="number" id="Icpf" name="Ncpf" class="form-control">
					</div>

					<div class="form-group">
						<label for="Iemail">E-mail</label>
						<input type="email" id="Iemail" name="Nemail" class="form-control">
					</div>
					<hr>
					<fieldset>
						<legend>Plano de Saúde</legend>
						<div class="form-group">
							<label for="Iplano">Plano:</label>
							<select id="Iplano" name="Nplano" class="form-control">
								<option value=""></option>
								<option value="">Unimed</option>
								<option value="">Unihosp</option>
							</select>
						</div>
						<div class="form-group">
							<label for="Imat">Matricula:</label>
							<input type="text" id="Imat" name="Nmat" class="form-control">
						</div>
					</fieldset>
					

					<!-- ID do usuário que está fazendo o cadastro-->
					<div class="form-group" >
						<input type="number" id="IidAten" name="NidAten" value="1" hidden>
					</div>
				</fieldset>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		</div>
	</div>

</div>
@endsection