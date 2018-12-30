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
			<form action="" method="POST" id="form-agenda-medica">
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
{{--
				<div class="row">
					<legend>Domingo</legend>

					<div class="col-sm-1">
						<label for="IDomTimeStart">Início:</label>
						<input type="time" name="NDomTimeStart" id="IDomTimeStart">
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
						<input type="time" name="NSegTimeStart" id="ISegTimeStart">
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
						<input type="time" name="NTerTimeStart" id="ITerTimeStart">
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
						<input type="time" name="NQuaTimeStart" id="IQuaTimeStart">
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
						<input type="time" name="NQuiTimeStart" id="IQuiTimeStart">
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
						<input type="time" name="NSexTimeStart" id="ISexTimeStart">
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
						<input type="time" name="NSabTimeStart" id="ISabTimeStart">
					</div>
					<div class="col-sm-1">
						<label for="ISabTimeEnd">Fim:</label>
						<input type="time" name="NSabTimeEnd" id="ISabTimeEnd">
					</div>
				</div>
--}}
				<table class="table table-hover table-dark">
				  <thead>
				    <tr>
				      <th scope="col">Domingo</th>
				      <th scope="col">Segunda</th>
				      <th scope="col">Terça-feira</th>
				      <th scope="col">Quarta-feira</th>
				      <th scope="col">Quinta-feira</th>
				      <th scope="col">Sexta-feira</th>
				      <th scope="col">Sábado</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				    	<th class="text-center" id="DomMat">Matutino</th>
				    	<th class="text-center" id="SegMat">Matutino</th>
				    	<th class="text-center" id="TerMat">Matutino</th>
				    	<th class="text-center" id="QuaMat">Matutino</th>
				    	<th class="text-center" id="QuiMat">Matutino</th>
				    	<th class="text-center" id="SexMat">Matutino</th>
				    	<th class="text-center" id="SabMat">Matutino</th>
				    </tr>
				    <tr>
				      	<th scope="row">
					      	<div class="col-sm-1">
								<label for="IDomMTimeStart">Início:</label>
								<input type="time" name="NDomMTimeStart" id="IDomMTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="IDomMTimeEnd">Fim:</label>
								<input type="time" name="NDomMTimeEnd" id="IDomMTimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="ISegMTimeStart">Início:</label>
								<input type="time" name="NSegMTimeStart" id="ISegMTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="ISegMTimeEnd">Fim:</label>
								<input type="time" name="NSegMTimeEnd" id="ISegMTimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="ITerMTimeStart">Início:</label>
								<input type="time" name="NTerMTimeStart" id="ITerMTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="ITerMTimeEnd">Fim:</label>
								<input type="time" name="NTerMTimeEnd" id="ITerMTimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="IQuaMTimeStart">Início:</label>
								<input type="time" name="NQuaMTimeStart" id="IQuaMTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="IQuaMTimeEnd">Fim:</label>
								<input type="time" name="NQuaMTimeEnd" id="IQuaMTimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="IQuiMTimeStart">Início:</label>
								<input type="time" name="NQuiMTimeStart" id="IQuiMTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="IQuiMTimeEnd">Fim:</label>
								<input type="time" name="NQuiMTimeEnd" id="IQuiMTimeEnd">
							</div>			
						</th>
						<th>
							<div class="col-sm-1">
								<label for="ISexMTimeStart">Início:</label>
								<input type="time" name="NSexMTimeStart" id="ISexMTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="ISexMTimeEnd">Fim:</label>
								<input type="time" name="NSexMTimeEnd" id="ISexMTimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="ISabMTimeStart">Início:</label>
								<input type="time" name="NSabMTimeStart" id="ISabMTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="ISabMTimeEnd">Fim:</label>
								<input type="time" name="NSabMTimeEnd" id="ISabMTimeEnd">
							</div>
						</th>
				    </tr>
				    <tr>
				    	<th class="text-center" id="DomVesp">Vespertino</th>
				    	<th class="text-center" id="SegVesp">Vespertino</th>
				    	<th class="text-center" id="TerVesp">Vespertino</th>
				    	<th class="text-center" id="QuaVesp">Vespertino</th>
				    	<th class="text-center" id="QuiVesp">Vespertino</th>
				    	<th class="text-center" id="SexVesp">Vespertino</th>
				    	<th class="text-center" id="SabVesp">Vespertino</th>
				    </tr>
				    <tr>
				    	<th scope="row">
					      	<div class="col-sm-1">
								<label for="IDomTTimeStart">Início:</label>
								<input type="time" name="NDomTTimeStart" id="IDomTTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="IDomTTimeEnd">Fim:</label>
								<input type="time" name="NDomTTimeEnd" id="IDomTTimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="ISegTTimeStart">Início:</label>
								<input type="time" name="NSegTTimeStart" id="ISegTTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="ISegTTimeEnd">Fim:</label>
								<input type="time" name="NSegTTimeEnd" id="ISegTTimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="ITerTTimeStart">Início:</label>
								<input type="time" name="NTerTTimeStart" id="ITerTTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="ITerTTimeEnd">Fim:</label>
								<input type="time" name="NTerTTimeEnd" id="ITerTTimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="IQuaTTimeStart">Início:</label>
								<input type="time" name="NQuaTTimeStart" id="IQuaTTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="IQuaTTimeEnd">Fim:</label>
								<input type="time" name="NQuaTTimeEnd" id="IQuaTTimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="IQuiTTimeStart">Início:</label>
								<input type="time" name="NQuiTTimeStart" id="IQuiTTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="IQuiTTimeEnd">Fim:</label>
								<input type="time" name="NQuiTTimeEnd" id="IQuiTTimeEnd">
							</div>			
						</th>
						<th>
							<div class="col-sm-1">
								<label for="ISexTTimeStart">Início:</label>
								<input type="time" name="NSexTTimeStart" id="ISexTTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="ISexTTimeEnd">Fim:</label>
								<input type="time" name="NSexTTimeEnd" id="ISexTTimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="ISabTTimeStart">Início:</label>
								<input type="time" name="NSabTTimeStart" id="ISabTTimeStart">
							</div>
							<div class="col-sm-1">
								<label for="ISabTTimeEnd">Fim:</label>
								<input type="time" name="NSabTTimeEnd" id="ISabTTimeEnd">
							</div>
						</th>
				    </tr>
				  </tbody>
				</table>
			</form>
		</div>
	</div>
</div>
<div id="urls" hidden="true">
	<p id="agenda-medico">{{ route('agenda.getMedico') }}</p>
	<p id="agenda-agenda">{{ route('agenda.getAgenda') }}</p>
</div>
@endsection

@section('customer-javaScript')
{{-- <script>--}}{{-- RETIRE O COMENTÁRIO DA TAG <SCRIPT> PARA VISUALIZAR O CÓDIGO COLORIDO --}} 
//Filtra os médicos ao escolher a especialidade
$(document).on('change', 'select#Iesp', function(){
	//
	let url = $('#urls').find('p#agenda-medico').text();
	let id = $(this).children("option:selected").val();
	console.log(url);
	console.log(id);
	$("#form-agenda-medica").find("#Imed").empty();
	//
	$.ajax({
		type: 'POST',
		url: url,
		dataType: 'json',
		data: {id:id},
	})
	.done(function(data) {
		$("#form-agenda-medica").find("#Imed").append("<option value=''></option>");
		$.each(data, function (i, item) {
			$("#form-agenda-medica").find("#Imed").append($('<option>', {
				value: item.idmedico,
				text: item.nome
			}));
		});
	})
	.fail(function(xhr) {
		//console.log("error");
	})
	.always(function() {
		//console.log("complete");
	});	
});

$(document).on('change', 'select#Imed', function(){
	//
	let url = $('#urls').find('p#agenda-agenda').text();
	let dataForm = $("#form-agenda-medica").serialize();
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'json',
		data: dataForm,
	})
	.done(function(data) {
		console.log(data);
	})
	.fail(function(xhr) {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
});

{{-- </script>--}} {{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection