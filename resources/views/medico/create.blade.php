@extends('layouts.app')


@section('title', 'Cadastro')

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
			<form action="{{ route('medico.store') }}" method="post">
				{{ csrf_field() }}
					<fieldset>
						<legend>Dados do Médico</legend>
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
							<input type="text" id="Icpf" name="Ncpf" class="form-control" placeholder="000.000.000-00" value="{{ old('Ncpf') }}" >
							{!! $errors->first('Ncpf', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>

						<div class="form-group" {{ $errors->has('Ncpf') ? 'has-error' : ''}}>
							<label for="Icrm">CRM:</label>
							<input type="number" id="Icrm" name="Ncrm" class="form-control" placeholder="0000000" value="{{ old('Ncrm') }}">
							{!! $errors->first('Ncrm', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
						<fieldset>
							<legend>Área de atuação</legend>
							<div class="from-group" {{ $errors->has('Nesp') ? 'has-error' : ''}}>
								<label for="Iesp">Especialidade</label>
								<select class="form-control" id="Iesp" name="Nesp">
									<option value="" ></option>
									@if(isset($especialidades))
										@foreach($especialidades as $especialidade)
											<option value="{{ $especialidade->idespecialidade }}">{{$especialidade->cbo}} - {{$especialidade->nome }}</option>
										@endforeach
									@endif	
								</select>
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

</div>

@endsection