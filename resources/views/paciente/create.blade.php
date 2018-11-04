@extends('layouts.app')

@section('title', 'Registro de Paciente')

@section('content')

<div class="container">

	<div class='row'>
		<div class="col-sm-10">
			<form action="{{ route('paciente.store') }}" method="post">
				{{ csrf_field() }}
					<fieldset>
						<legend>Dados do Paciente</legend>
						<div class="form-group">
							<label for="Inome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control" value="{{ old('Nnome') }}">
						</div>

						<div class="form-group">
							<label for="Inasc">Data Nascimento:</label>
							<input type="date" id="Inasc" name="Nnasc" class="form-control" value="{{ old('Nnasc') }}">
						</div>
						<div class="form-group">
							Sexo:
							<div class="form-check">
								<input class="form-check-input" type="radio" name="Nsexo" id="IsexoM" value="M" {{ old('Nsexo') == "M" ? 'checked' : ''}} checked>
								<label class="form-check-label" for="IsexoM">
							    	Masculino
							  	</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="Nsexo" id="IsexoF" value="F" {{ old('Nsexo') == "F" ? 'checked' : ''}}>
								<label class="form-check-label" for="IsexoF">
							    	Femenino
							  	</label>
							</div>
						</div>
						<div class="form-group">
							<label for="Icpf">CPF:</label>
							<input type="text" id="Icpf" name="Ncpf" class="form-control" value="{{ old('Ncpf') }}" >
						</div>

						<div class="form-group">
							<label for="Iemail">E-mail</label>
							<input type="email" id="Iemail" name="Nemail" class="form-control" value="{{ old('Nemail') }}">
						</div>
						<hr>

						<fieldset>
							<legend>Telefones:</legend> 
							<div class="form-group">
								<div>
									<label for="ItelR">Residencial:</label>
									<input type="text" id="ItelR" name="NtelR" class="form-control" placeholder="type here..." value="{{ old('NtelR') }}">
								</div>
								<div>
									<label for="ItelE">Empresarial:</label>
									<input type="text" id="ItelE" name="NtelE" class="form-control bfh-phone" placeholder="type here..." value="{{ old('NtelE') }}">
								</div>
								<div>
									<label for="ItelC">Celular:</label>
									<input type="text" id="ItelC" name="NtelC" class="form-control" placeholder="type here..." value="{{ old('NtelC') }}">
								</div>
							</div>
						<fieldset>
						<legend>Dados do Plano de Saúde</legend>
						<div class="form-group">
							<label for="IplanoId">Plano:</label>
							<select id="IplanoId" name="NplanoId" class="form-control">
								{{ $i = 0 }}
								<option value=""></option>
									@foreach($planos as $plano)
										<option value="{{ $plano->id}}">{{ ++$i }} - {{ $plano->nome }}</option>
									@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="Imat">Matricula:</label>
							<input type="text" id="Imat" name="Nmat" class="form-control" value="{{ old('Nmat') }}">
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

@section('customer-javaScript')
{{-- <script> --}}{{-- RETIRE O COMENTÁRIO DA TAG <SCRIPT> PARA VISUALIZAR O CÓDIGO COLORIDO --}}	

{{-- </script> --}}{{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection
