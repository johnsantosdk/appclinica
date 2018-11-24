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
			<form action="{{ route('especialidade.store') }}" method="post">
				{{ csrf_field() }}
					<fieldset>
						<legend>Especialidade</legend>
						<div class="form-group" {{ $errors->has('Nnome') ? 'has-error' : ''}}>
							<label for="Inome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control" value="{{ old('Nnome') }}">
							{!! $errors->first('Nnome', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
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