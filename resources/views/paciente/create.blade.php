@extends('layouts.app')

@section('title', 'Registro de Paciente')

@section('content')

<div class="container">

	<div class='row'>
		    @if (Session::has('flash_message'))
		        <div class="container">
		            <div class="row">
		                <div class="col-md-10 col-md-offset-1">
		                    <div align="center" class="alert {{Session::get('flash_message')['class']}}">
		                        {{ Session::get('flash_message')['msg'] }}
		                    </div>
		                </div>
		            </div>
		        </div>
    		@endif
		<div class="col-sm-10">
			<form action="{{ route('paciente.store') }}" method="post">
				{{ csrf_field() }}
					<fieldset>
						<legend>Dados do Paciente</legend>
						<div class="form-group" {{ $errors->has('Nnome') ? 'has-error' : ''}}>
							<label for="Inome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control" value="{{ old('Nnome') }}">
							{!! $errors->first('Nnome', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>

						<div class="form-group" {{ $errors->has('Nnasc') ? 'has-error' : ''}}>
							<label for="Inasc">Data Nascimento:</label>
							<input type="date" id="Inasc" name="Nnasc" class="form-control" value="{{ old('Nnasc') }}">
							{!! $errors->first('Nnasc', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>

						<div class="form-group" {{ $errors->has('Nsexo') ? 'has-error' : ''}}>
							<label for="Isexo">Sexo:</label>
							<select name="Nsexo" id="Isexo" class="form-control">
								<option value=""></option>
								<option value="MASCULINO">Masculino</option>
								<option value="FEMENINO">Femenino</option>
							</select>
							{!! $errors->first('Nsexo', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
						<div class="form-group" {{ $errors->has('Ncpf') ? 'has-error' : ''}}>
							<label for="Icpf">CPF:</label>
							<input type="text" id="Icpf" name="Ncpf" class="form-control" value="{{ old('Ncpf') }}" >
							{!! $errors->first('Ncpf', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>

						<div class="form-group" {{ $errors->has('Ncpf') ? 'has-error' : ''}}>
							<label for="Iemail">E-mail</label>
							<input type="email" id="Iemail" name="Nemail" class="form-control" value="{{ old('Nemail') }}">
							{!! $errors->first('Nemail', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
						<hr>

						<fieldset>
							<legend>Telefones:</legend> 
							<div class="form-group">
								<div {{ $errors->has('NtelR') ? 'has-error' : ''}}>
									<label for="ItelR">Residencial:</label>
									<input type="text" id="ItelR" name="NtelR" class="form-control" placeholder="type here..." value="{{ old('NtelR') }}">
									{!! $errors->first('NtelR', '<p class="help-block alert alert-danger">:message</p>') !!}
								</div>
								<div {{ $errors->has('NtelE') ? 'has-error' : ''}}>
									<label for="ItelE">Empresarial:</label>
									<input type="text" id="ItelE" name="NtelE" class="form-control bfh-phone" placeholder="type here..." value="{{ old('NtelE') }}">
									{!! $errors->first('NtelE', '<p class="help-block alert alert-danger">:message</p>') !!}
								</div>
								<div {{ $errors->has('NtelC') ? 'has-error' : ''}}>
									<label for="ItelC">Celular:</label>
									<input type="text" id="ItelC" name="NtelC" class="form-control" placeholder="type here..." value="{{ old('NtelC') }}">
									{!! $errors->first('NtelC', '<p class="help-block alert alert-danger">:message</p>') !!}
								</div>
							</div>
						<fieldset>
						<legend>Dados do Plano de Saúde</legend>
						<div class="form-group" {{ $errors->has('NplanoId') ? 'has-error' : ''}}>
							<label for="IplanoId">Plano:</label>
							<select id="IplanoId" name="NplanoId" class="form-control">
								{{ $i = 0 }}
								<option value=""></option>
									@foreach($planos as $plano)
										<option value="{{ $plano->idplano}}">{{ ++$i }} - {{ $plano->nome }}</option>
									@endforeach
							</select>
							{!! $errors->first('NplanoId', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
						<div class="form-group" {{ $errors->has('Nmat') ? 'has-error' : ''}}>
							<label for="Imat">Matricula:</label>
							<input type="text" id="Imat" name="Nmat" class="form-control" value="{{ old('Nmat') }}">
							{!! $errors->first('Nmat', '<p class="help-block alert alert-danger">:message</p>') !!}
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
