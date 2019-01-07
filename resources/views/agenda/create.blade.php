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
								<label for="I-dom-m-TimeStart">Início:</label>
								<input type="time" name="N-dom-m-TimeStart" id="I-dom-m-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-dom-m-TimeEnd">Fim:</label>
								<input type="time" name="N-dom-m-TimeEnd" id="I-dom-m-TimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-seg-m-TimeStart">Início:</label>
								<input type="time" name="N-seg-m-TimeStart" id="I-seg-m-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-seg-m-TimeEnd">Fim:</label>
								<input type="time" name="N-seg-m-TimeEnd" id="I-seg-m-TimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-ter-m-TimeStart">Início:</label>
								<input type="time" name="N-ter-m-TimeStart" id="I-ter-m-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-ter-m-TimeEnd">Fim:</label>
								<input type="time" name="N-ter-m-TimeEnd" id="I-ter-m-TimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-qua-m-TimeStart">Início:</label>
								<input type="time" name="N-qua-m-TimeStart" id="I-qua-m-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-qua-m-TimeEnd">Fim:</label>
								<input type="time" name="N-qua-m-TimeEnd" id="I-qua-m-TimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-qui-m-TimeStart">Início:</label>
								<input type="time" name="N-qui-m-TimeStart" id="I-qui-m-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-qui-m-TimeEnd">Fim:</label>
								<input type="time" name="N-qui-m-TimeEnd" id="I-qui-m-TimeEnd">
							</div>			
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-sex-m-TimeStart">Início:</label>
								<input type="time" name="N-sex-m-TimeStart" id="I-sex-m-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-sex-m-TimeEnd">Fim:</label>
								<input type="time" name="N-sex-m-TimeEnd" id="I-sex-m-TimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-sab-m-TimeStart">Início:</label>
								<input type="time" name="N-sab-m-TimeStart" id="I-sab-m-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-sab-m-TimeEnd">Fim:</label>
								<input type="time" name="N-sab-m-TimeEnd" id="I-sab-m-TimeEnd">
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
								<label for="I-dom-t-TimeStart">Início:</label>
								<input type="time" name="N-dom-t-TimeStart" id="I-dom-t-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-dom-t-TimeEnd">Fim:</label>
								<input type="time" name="N-dom-t-TimeEnd" id="I-dom-t-TimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-seg-t-TimeStart">Início:</label>
								<input type="time" name="N-seg-t-TimeStart" id="I-seg-t-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-seg-t-TimeEnd">Fim:</label>
								<input type="time" name="N-seg-t-TimeEnd" id="I-seg-t-TimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-ter-t-TimeStart">Início:</label>
								<input type="time" name="N-ter-t-TimeStart" id="I-ter-t-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-ter-t-TimeEnd">Fim:</label>
								<input type="time" name="N-ter-t-TimeEnd" id="I-ter-t-TimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-qua-t-TimeStart">Início:</label>
								<input type="time" name="N-qua-t-TimeStart" id="I-qua-t-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-qua-t-TimeEnd">Fim:</label>
								<input type="time" name="N-qua-t-TimeEnd" id="I-qua-t-TimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-qui-t-TimeStart">Início:</label>
								<input type="time" name="N-qui-t-TimeStart" id="I-qui-t-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-qui-t-TimeEnd">Fim:</label>
								<input type="time" name="N-qui-t-TimeEnd" id="I-qui-t-TimeEnd">
							</div>			
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-sex-t-TimeStart">Início:</label>
								<input type="time" name="N-sex-t-TimeStart" id="I-sex-t-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-sex-t-TimeEnd">Fim:</label>
								<input type="time" name="N-sex-t-TimeEnd" id="I-sex-t-TimeEnd">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-sab-t-TimeStart">Início:</label>
								<input type="time" name="N-sab-t-TimeStart" id="I-sab-t-TimeStart">
							</div>
							<div class="col-sm-1">
								<label for="I-sab-t-TimeEnd">Fim:</label>
								<input type="time" name="N-sab-t-TimeEnd" id="I-sab-t-TimeEnd">
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
		$('#form-agenda-medica').find('#I-qua-m-TimeStart').val(data.agenda.wednesday_morning_start_time);

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