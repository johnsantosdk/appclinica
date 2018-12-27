@extends('layouts.app')

@section('title', 'Cadastro de Agenda')

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
			<form action="">
				<div class="form-group">
					<label for="Iesp">Especialidade:</label>
					<select name="Nesp" id="Iesp" class="form-control">
						<option value=""></option>
						@if(isset($especialidades))
							@foreach ($especialidades as $especialidade)
								<option value="{{ $especialidade->idespecialidade }}">{{ $especialidade->cbo }} - {{ $especialidade->nome }}</option>
							@endforeach
						@endif
					</select>
				</div>

				<div class="form-group">
					<label for="Imed">Médico:</label>
					<select name="Nmed" id="Imed" class="form-control">
						<option value=""></option>
					</select>
				</div>	
				<div class="row">
					<legend>Domingo</legend>
					<div class="col-sm-1">
						<label for="IDomTimeStart">Início:</label>
						<input type="time" name="NDomTimeEnd" id="IDomTimeEnd">
					</div>
					<div class="col-sm-1">
						<label for="IDomTimeEnd">Fim:</label>
						<input type="time" name="NDomTimeEnd" id="IDomTimeEnd">
					</div>
				</div>
				<div class="row">
					<legend>Segunda-feira</legend>
					<div class="col-sm-1">
						<label for="ISegTimeStart">Início:</label>
						<input type="time" name="NSegTimeEnd" id="ISegTimeEnd">
					</div>
					<div class="col-sm-1">
						<label for="ISegTimeEnd">Fim:</label>
						<input type="time" name="NSegTimeEnd" id="ISegTimeEnd">
					</div>
				</div>
				<div class="row">
					<legend>Terça-feira</legend>
					<div class="col-sm-1">
						<label for="ITerTimeStart">Início:</label>
						<input type="time" name="NTerTimeEnd" id="ITerTimeEnd">
					</div>
					<div class="col-sm-1">
						<label for="ITerTimeEnd">Fim:</label>
						<input type="time" name="NTerTimeEnd" id="ITerTimeEnd">
					</div>
				</div>
				<div class="row">
					<legend>Quarta-feira</legend>
					<div class="col-sm-1">
						<label for="IQuaTimeStart">Início:</label>
						<input type="time" name="NQuaTimeEnd" id="IQuaTimeEnd">
					</div>
					<div class="col-sm-1">
						<label for="IQuaTimeEnd">Fim:</label>
						<input type="time" name="NQuaTimeEnd" id="IQuaTimeEnd">
					</div>				
				</div>
				<div class="row">
					<legend>Quinta-feira</legend>
					<div class="col-sm-1">
						<label for="IQuiTimeStart">Início:</label>
						<input type="time" name="NQuiTimeEnd" id="IQuiTimeEnd">
					</div>
					<div class="col-sm-1">
						<label for="IQuiTimeEnd">Fim:</label>
						<input type="time" name="NQuiTimeEnd" id="IQuiTimeEnd">
					</div>		
				</div>
				<div class="row">
					<legend>Sexta</legend>
					<div class="col-sm-1">
						<label for="ISexTimeStart">Início:</label>
						<input type="time" name="NSexTimeEnd" id="ISexTimeEnd">
					</div>
					<div class="col-sm-1">
						<label for="ISexTimeEnd">Fim:</label>
						<input type="time" name="NSexTimeEnd" id="ISexTimeEnd">
					</div>
				</div>
				<div class="row">
					<legend>Sábado</legend>
					<div class="col-sm-1">
						<label for="ISabTimeStart">Início:</label>
						<input type="time" name="NSabTimeEnd" id="ISabTimeEnd">
					</div>
					<div class="col-sm-1">
						<label for="ISabTimeEnd">Fim:</label>
						<input type="time" name="NSabTimeEnd" id="ISabTimeEnd">
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

@endsection