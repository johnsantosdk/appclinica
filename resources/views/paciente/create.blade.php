@extends('layouts.app')

@section('title', 'Registro de Paciente')

@section('content')

<div class="container">

	<div class='row'>
		<div class="col-sm-10">
			<form action="{{ action('PacienteController@store') }}" method="post">
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
							Sexo:
							<div class="form-check">

								<input class="form-check-input" type="radio" name="Nsexo" id="IsexoM" value="M" checked>
								<label class="form-check-label" for="IsexoM">
							    	Masculino
							  	</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="Nsexo" id="IsexoF" value="F">
								<label class="form-check-label" for="IsexoF">
							    	Femenino
							  	</label>
							</div>
						</div>
						<div class="form-group">
							<label for="Icpf">CPF:</label>
							<input type="number" id="Icpf" name="Ncpf" class="form-control" >
						</div>

						<div class="form-group">
							<label for="Iemail">E-mail</label>
							<input type="email" id="Iemail" name="Nemail" class="form-control">
						</div>
						<hr>

						<fieldset>
							<legend>Telefones:</legend> 
							<div class="form-group">
								<div>
									<label for="ItelR">Residencial:</label>
									<input type="text" id="ItelR" name="NtelR" class="form-control">
								</div>
								<div>
									<label for="ItelE">Empresarial:</label>
									<input type="text" id="ItelE" name="NtelE" class="form-control bfh-phone" data-format="+55 (ddd) d dddd-dddd">
								</div>
								<div>
									<label for="ItelC">Celular:</label>
									<input type="text" id="ItelC" name="NtelC" class="form-control">
								</div>

								{{-- div teste --}}
									<div>
									    <label for="phone">Phone</label>
									    <!-- or set via JS -->
									    <input id="phone" type="text" />
									</div>
							</div>
						<fieldset>
						<legend>Dados do Plano de Saúde</legend>
						<div class="form-group">
							<label for="Iplano">Plano:</label>
							<select id="Iplano" name="Nplano" class="form-control">
								{{ $i = 0 }}
								<option value=""></option>
									@foreach($planos as $plano)
										<option value="{{ $plano->id}}">{{ ++$i }} - {{ $plano->nome }}</option>
									@endforeach
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
