@extends('layouts.app')

@section('title', 'Cadastro/Alteração de Agenda Médica')

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

				<table class="table table-hover table-dark">
				  <thead>
				    <tr>
				      <th scope="col" class="text-center" >Domingo</th>
				      <th scope="col" class="text-center" >Segunda</th>
				      <th scope="col" class="text-center" >Terça-feira</th>
				      <th scope="col" class="text-center" >Quarta-feira</th>
				      <th scope="col" class="text-center" >Quinta-feira</th>
				      <th scope="col" class="text-center" >Sexta-feira</th>
				      <th scope="col" class="text-center" >Sábado</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				    	<th class="text-center costumer-bg-color" id="DomMat">Matutino</th>
				    	<th class="text-center costumer-bg-color" id="SegMat">Matutino</th>
				    	<th class="text-center costumer-bg-color" id="TerMat">Matutino</th>
				    	<th class="text-center costumer-bg-color" id="QuaMat">Matutino</th>
				    	<th class="text-center costumer-bg-color" id="QuiMat">Matutino</th>
				    	<th class="text-center costumer-bg-color" id="SexMat">Matutino</th>
				    	<th class="text-center costumer-bg-color" id="SabMat">Matutino</th>
				    </tr>
				    <tr>
				      	<th scope="row">
					      	<div class="col-sm-1">
								<label for="I-dom-m-TimeStart">Início:</label>
								<input type="time" name="N-dom-m-TimeStart" id="I-dom-m-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-dom-m-TimeEnd">Fim:</label>
								<input type="time" name="N-dom-m-TimeEnd" id="I-dom-m-TimeEnd" class="clear-input">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-seg-m-TimeStart">Início:</label>
								<input type="time" name="N-seg-m-TimeStart" id="I-seg-m-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-seg-m-TimeEnd">Fim:</label>
								<input type="time" name="N-seg-m-TimeEnd" id="I-seg-m-TimeEnd" class="clear-input">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-ter-m-TimeStart">Início:</label>
								<input type="time" name="N-ter-m-TimeStart" id="I-ter-m-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-ter-m-TimeEnd">Fim:</label>
								<input type="time" name="N-ter-m-TimeEnd" id="I-ter-m-TimeEnd" class="clear-input">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-qua-m-TimeStart">Início:</label>
								<input type="time" name="N-qua-m-TimeStart" id="I-qua-m-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-qua-m-TimeEnd">Fim:</label>
								<input type="time" name="N-qua-m-TimeEnd" id="I-qua-m-TimeEnd" class="clear-input">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-qui-m-TimeStart">Início:</label>
								<input type="time" name="N-qui-m-TimeStart" id="I-qui-m-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-qui-m-TimeEnd">Fim:</label>
								<input type="time" name="N-qui-m-TimeEnd" id="I-qui-m-TimeEnd" class="clear-input">
							</div>			
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-sex-m-TimeStart">Início:</label>
								<input type="time" name="N-sex-m-TimeStart" id="I-sex-m-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-sex-m-TimeEnd">Fim:</label>
								<input type="time" name="N-sex-m-TimeEnd" id="I-sex-m-TimeEnd" class="clear-input">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-sab-m-TimeStart">Início:</label>
								<input type="time" name="N-sab-m-TimeStart" id="I-sab-m-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-sab-m-TimeEnd">Fim:</label>
								<input type="time" name="N-sab-m-TimeEnd" id="I-sab-m-TimeEnd" class="clear-input">
							</div>
						</th>
				    </tr>
				    <tr>
				    	<th class="text-center costumer-bg-color" id="DomVesp">Vespertino</th>
				    	<th class="text-center costumer-bg-color" id="SegVesp">Vespertino</th>
				    	<th class="text-center costumer-bg-color" id="TerVesp">Vespertino</th>
				    	<th class="text-center costumer-bg-color" id="QuaVesp">Vespertino</th>
				    	<th class="text-center costumer-bg-color" id="QuiVesp">Vespertino</th>
				    	<th class="text-center costumer-bg-color" id="SexVesp">Vespertino</th>
				    	<th class="text-center costumer-bg-color" id="SabVesp">Vespertino</th>
				    </tr>
				    <tr>
				    	<th scope="row">
					      	<div class="col-sm-1">
								<label for="I-dom-t-TimeStart">Início:</label>
								<input type="time" name="N-dom-t-TimeStart" id="I-dom-t-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-dom-t-TimeEnd">Fim:</label>
								<input type="time" name="N-dom-t-TimeEnd" id="I-dom-t-TimeEnd" class="clear-input">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-seg-t-TimeStart">Início:</label>
								<input type="time" name="N-seg-t-TimeStart" id="I-seg-t-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-seg-t-TimeEnd">Fim:</label>
								<input type="time" name="N-seg-t-TimeEnd" id="I-seg-t-TimeEnd" class="clear-input">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-ter-t-TimeStart">Início:</label>
								<input type="time" name="N-ter-t-TimeStart" id="I-ter-t-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-ter-t-TimeEnd">Fim:</label>
								<input type="time" name="N-ter-t-TimeEnd" id="I-ter-t-TimeEnd" class="clear-input">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-qua-t-TimeStart">Início:</label>
								<input type="time" name="N-qua-t-TimeStart" id="I-qua-t-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-qua-t-TimeEnd">Fim:</label>
								<input type="time" name="N-qua-t-TimeEnd" id="I-qua-t-TimeEnd" class="clear-input">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-qui-t-TimeStart">Início:</label>
								<input type="time" name="N-qui-t-TimeStart" id="I-qui-t-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-qui-t-TimeEnd">Fim:</label>
								<input type="time" name="N-qui-t-TimeEnd" id="I-qui-t-TimeEnd" class="clear-input">
							</div>			
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-sex-t-TimeStart">Início:</label>
								<input type="time" name="N-sex-t-TimeStart" id="I-sex-t-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-sex-t-TimeEnd">Fim:</label>
								<input type="time" name="N-sex-t-TimeEnd" id="I-sex-t-TimeEnd" class="clear-input">
							</div>
						</th>
						<th>
							<div class="col-sm-1">
								<label for="I-sab-t-TimeStart">Início:</label>
								<input type="time" name="N-sab-t-TimeStart" id="I-sab-t-TimeStart" class="clear-input">
							</div>
							<div class="col-sm-1">
								<label for="I-sab-t-TimeEnd">Fim:</label>
								<input type="time" name="N-sab-t-TimeEnd" id="I-sab-t-TimeEnd" class="clear-input">
							</div>
						</th>
				    </tr>
				  </tbody>
				</table>
				<a href="#" class="btn btn-primary" id="btn-submit-salvar-form-agenda" >Salvar</a>
				<a href="#" class="btn btn-primary" id="btn-submit-cadastrar-form-agenda">Cadastar</a>
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
$('#form-agenda-medica').find('#btn-submit-salvar-form-agenda').hide();
$('#form-agenda-medica').find('#btn-submit-cadastrar-form-agenda').hide();
$(document).on('change', 'select#Iesp', function(){
	$('#form-agenda-medica').find('#btn-submit-salvar-form-agenda').hide();
	$('#form-agenda-medica').find('#btn-submit-cadastrar-form-agenda').hide();
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
	$('#form-agenda-medica').find('#btn-submit-salvar-form-agenda').hide();
	$('#form-agenda-medica').find('#btn-submit-cadastrar-form-agenda').hide();
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
		$('#form-agenda-medica').find('input.clear-input').val('');
		$('#form-agenda-medica').find('.costumer-bg-color').css({'background-color':'rgba(33,37,41,1)'});
		if(data.exist == 1){
			$('#form-agenda-medica').find('#btn-submit-salvar-form-agenda').show();
			//DOMINGO
			if(data.agenda.sunday == 1){
				if(data.agenda.sunday_morning == 1){
					$('#form-agenda-medica').find('#DomMat').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-dom-m-TimeStart').val(data.agenda.sunday_morning_start_time);
					$('#form-agenda-medica').find('#I-dom-m-TimeEnd').val(data.agenda.sunday_morning_end_time);
				}if(data.agenda.sunday_afternoon == 1){
					$('#form-agenda-medica').find('#DomVesp').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-dom-t-TimeEnd').val(data.agenda.sunday_afternoon_start_time);
					$('#form-agenda-medica').find('#I-dom-t-TimeEnd').val(data.agenda.sunday_afternoon_end_time);
				}
			}
			//SENGUNDA
			if(data.agenda.monday == 1){
				if(data.agenda.monday_morning == 1){
					$('#form-agenda-medica').find('#SegMat').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-seg-m-TimeStart').val(data.agenda.monday_morning_start_time);
					$('#form-agenda-medica').find('#I-seg-m-TimeEnd').val(data.agenda.monday_morning_end_time);
				}if(data.agenda.monday_afternoon == 1){
					$('#form-agenda-medica').find('#SegVesp').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-seg-t-TimeStart').val(data.agenda.monday_afternoon_start_time);
					$('#form-agenda-medica').find('#I-seg-t-TimeEnd').val(data.agenda.monday_afternoon_end_time);
				}
			}
			//TERÇA
			if(data.agenda.tuesday == 1){
				if(data.agenda.tuesday_morning == 1){
					$('#form-agenda-medica').find('#TerMat').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-ter-m-TimeStart').val(data.agenda.tuesday_morning_start_time);
					$('#form-agenda-medica').find('#I-ter-m-TimeEnd').val(data.agenda.tuesday_morning_end_time);
				}if(data.agenda.tuesday_afternoon == 1)
					$('#form-agenda-medica').find('#TerVesp').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-ter-t-TimeStart').val(data.agenda.tuesday_afternoon_start_time);
					$('#form-agenda-medica').find('#I-ter-t-TimeEnd').val(data.agenda.tuesday_afternoon_end_time);
			}
			//QUARTA
			if(data.agenda.wednesday == 1){
				if(data.agenda.wednesday_morning == 1){
					$('#form-agenda-medica').find('#QuaMat').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-qua-m-TimeStart').val(data.agenda.wednesday_morning_start_time);
					$('#form-agenda-medica').find('#I-qua-m-TimeEnd').val(data.agenda.wednesday_morning_end_time);
				}if(data.agenda.wednesday_afternoon == 1)
					$('#form-agenda-medica').find('#QuaVesp').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-qua-t-TimeStart').val(data.agenda.wednesday_afternoon_start_time);
					$('#form-agenda-medica').find('#I-qua-t-TimeEnd').val(data.agenda.wednesday_afternoon_end_time);
			}
			//QUINTA
			if(data.agenda.thursday == 1){
				if(data.agenda.thursday_morning == 1){
					$('#form-agenda-medica').find('#QuiMat').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-qui-m-TimeStart').val(data.agenda.thursday_morning_start_time);
					$('#form-agenda-medica').find('#I-qui-m-TimeEnd').val(data.agenda.thursday_morning_end_time);
				}if(data.agenda.thursday_afternoon == 1){
					$('#form-agenda-medica').find('#QuiVesp').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-qui-t-TimeStart').val(data.agenda.thursday_afternoon_start_time);
					$('#form-agenda-medica').find('#I-qui-t-TimeEnd').val(data.agenda.thursday_afternoon_end_time);
				}
			}
			//SEXTA
			if(data.agenda.friday == 1){
				if(data.agenda.friday_morning == 1){
					$('#form-agenda-medica').find('#SexMat').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-sex-m-TimeStart').val(data.agenda.friday_morning_start_time);
					$('#form-agenda-medica').find('#I-sex-m-TimeEnd').val(data.agenda.friday_morning_end_time);
				}if(data.agenda.friday_afternoon == 1){
					$('#form-agenda-medica').find('#SexVesp').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-sex-t-TimeStart').val(data.agenda.friday_afternoon_start_time);
					$('#form-agenda-medica').find('#I-sex-t-TimeEnd').val(data.agenda.friday_afternoon_end_time);
				}
			}
			//SÁBADO
			if(data.agenda.saturday == 1){
				if(data.agenda.saturday_morning == 1){
					$('#form-agenda-medica').find('#SabMat').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-sab-m-TimeStart').val(data.agenda.saturday_morning_start_time);
					$('#form-agenda-medica').find('#I-sab-m-TimeEnd').val(data.agenda.saturday_morning_end_time);
				}if(data.agenda.saturday_afternoon == 1){
					$('#form-agenda-medica').find('#SabVesp').css({'background-color':'rgba(77,255,77,1)'});
					$('#form-agenda-medica').find('#I-sab-m-TimeStart').val(data.agenda.saturday_afternoon_start_time);
					$('#form-agenda-medica').find('#I-sab-m-TimeEnd').val(data.agenda.saturday_afternoon_end_time);
				}
			}
		}if(data.exist == 0){
			$('#form-agenda-medica').find('#btn-submit-cadastrar-form-agenda').show();

			console.log('Não há agenda cadastrada para este médico');
		}
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