@extends('layouts.app')

@section('title', 'Registro de Consulta')

@section('content')

<div class="container">

	<div class='row'>
		<div class="col-sm-6">
			<h2>AGENDAR</h2>
			<div class="" id="div-form-search">
				<form  action="#" method="POST"  id="form-search-paciente">
					{{ csrf_field() }}
					<p id="action-url" hidden="true">{{ route('consulta.findPaciente') }}</p>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="Inome">Nome:</label>
								<input type="text" id="Inome" name="Nnome" class="form-control" value="{{ old('Nnome') }}">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="Icpf">CPF:</label>
								<input type="text" id="Icpf" name="Ncpf" class="form-control" placeholder="000.000.000-00">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="Inasc">Data Nascimento:</label>
								<input type="date" id="Inasc" name="Nnasc" class="form-control">
							</div>
						</div>

					</div>
					<a id="send-data" href="#" class="btn btn-primary">Pesquisar paciente</a>
				</form>
			</div>

			@if(isset($pacientes) && count($pacientes) == 0)
				<div class="alert alert-info" id="testFade">
	  				<strong>Sem resultas!</strong> Nenhum resultado encontrado para os dados informados acima.
				</div>
			@endif
			<div class="" id="div-form-consulta">
				<form action="#" method="POST" id="form-ajax-request-consulta">
					{{ csrf_field() }}
					<p id="action-url-form-consulta" hidden="true">{{ route('consulta.addConsulta')}}</p>
					<div class="table-responsive">
		  				<table class="table" id="tableListPac" style='background-color: rgba(194, 223, 245,0.3); border-radius: 10px'>
							<thead class="">
								<tr>
									<th scope="col" class="">Nome</th>
									<th scope="col" class="text-center">CPF</th>
									<th scope="col" class="text-center">Convênio</th>
									<th scope="col" class="text-center">Selecionar</th>
								</tr>
							</thead>
							<tbody id="pacientes-list">
							</tbody>
							<tfooter>
								<tr>
									<th scope="col" class="">Nome</th>
									<th scope="col" class="text-center">CPF</th>
									<th scope="col" class="text-center">Convênio</th>
									<th scope="col" class="text-center">Selecionar</th>
								</tr>
							</tfooter>
		  				</table>
					</div> 

					<div class="form-group">
						<label for="Iesp">Especialidade:</label>
						<select id="Iesp" name="Nesp" class="form-control">
							<option value=""></option>
							@if(isset($especialidades))
								@foreach($especialidades as $especialidade)
									<option value="{{ $especialidade->idespecialidade }}">{{ $especialidade->cbo }} - {{ $especialidade->nome }}</option>
								@endforeach
							@endif
						</select>
					</div>
					<div class="form-group">
						<label for="Imed">Médico:</label>
						<select id="Imed" name="Nmed" class="form-control">
							<option value=""></option>
						</select>
					</div>
					<div class="form-group">
						<label for="Idata">Data:</label>
						<input type="date" id="Idata" name="Ndata" class="form-control">
					</div>
					<div class="form-group">
						<label for="Ihor">Horário:</label>
						<select id="Ihor" name="Nhor" class="form-control">
							<option value=""></option>
							<option value="1">Manhã</option>
							<option value="2">Tarde</option>
						</select>
						{{-- <input type="time" id="Ihor" name="Nhor" class="form-control"> --}}
					</div>
					{{-- <button class="btn btn-primary" id="btn-list-agendados">Disponibilidade</button> --}}
					<a href="#" class="btn btn-primary" id="submitAgendaConsulta" >Agendar</a>
				</form>
			</div>
		</div>

		<div class="col-sm-6">
			<h2>AGENDADOS</h2>
			<div class="">
				<p id="filtro-list"></p>
				<div class="table-responsive">
	  				<table class="table" id="tableListConsultas">
						<thead class="">
							<tr>
								<th scope="col">ID</th>
								<th scope="col" class="">Nome</th>
								<th scope="col" class="text-center">CPF</th>
								<th scope="col" class="text-center">Convênio</th>
							</tr>
						</thead>
						<tbody id="consultas-list">

						</tbody>
	  				</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('customer-javaScript')
{{-- <script>--}}{{-- RETIRE O COMENTÁRIO DA TAG <SCRIPT> PARA VISUALIZAR O CÓDIGO COLORIDO --}} 
$('#tableListPac').hide();
$('#tableListConsultas').hide();

//Filtra os médicos ao escolher a especialidade
$(document).on('change', 'select#Iesp', function(){
	$('select#Ihor').val($('#Ihor option[selected]').val());
	//
	$('#filtro-list').find('p').remove();
	//
	$("tbody#consultas-list").find('tr').remove();
	//
	let id = $(this).children("option:selected").val();
	$("#form-ajax-request-consulta").find("#Imed").empty();
	//console.log("value before: "+id);
	//
	$.ajax({
		type: 'POST',
		url: '{{ route('consulta.medico') }}',
		dataType: 'json',
		data: {id:id},
	})
	.done(function(data) {
		$.each(data, function (i, item) {
			$("#form-ajax-request-consulta").find("#Imed").append($('<option>', {
				value: item.idmedico,
				text: item.nome
			}));
		});
	})
	.fail(function(xhr) {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});	
});

$(document).on('change', 'select#Ihor', function(){
	//
	let id = 	$('select#Imed').children("option:selected").val();
	let date   = 	$('input#Idata').val();
	let turno   = 	$('select#Ihor').children("option:selected").val();
	//
	let esp = 	$('select#Iesp').children("option:selected").text();
	let medico = 	$('select#Imed').children("option:selected").text();
	let manhaOUtarde = turno == 1 ? 'Manhã':'Tarde';

	//console.log('Médico: '+id+' Data: '+date+' Turno: '+turno);

	$.ajax({
		type: 'POST',
		url: '{{ route('consulta.filtro') }}',
		dataType: 'json',
		data: {id:id, date: date, turno: turno},
	})
	.done(function(data) {
		let dataAgendado = new Date(date);
		//console.log(data);
		$('#filtro-list').find('p').remove();
		$("tbody#consultas-list").find('tr').remove();
		//
		let consulta_qtd = typeof data.consultas === 'undefined' ? 0 : data.consultas.length;
		//
		if(typeof data.object !== 'undefined'){
		
		if(data.object.boolean == 1){
			//console.log('turno: '+turno);
			//Manhã
			if(turno == 1){
				if(data.object.morning == 1){
					$('#tableListConsultas').show();
					$('#filtro-list').append("<p class='alert alert-success'> "+esp+" > "+medico+" > "+date+" > "+manhaOUtarde+"</p>");
					$('#filtro-list').append("<p class='alert alert-success'>Paciente(s) agendado(s): "+consulta_qtd+"</p>");
					//
					if(consulta_qtd > 0){
						$.each(data.consultas, function (i, item) {
							$("#tableListConsultas").find("tbody#consultas-list").append("<tr id='paciente"+item.idpaciente+"'>{{-- id de cada registro --}}<th scope='row'>"+item.idpaciente+"</th><td class='text-center'>"+item.nome+"</td><td class='text-center'>"+item.cpf+"</td><td class='text-center'>"+item.convenio+"</td></tr>");
						});
					}
				}
				if(data.object.morning == 0){
					$('#filtro-list').append("<p class='alert alert-danger'> "+esp+" > "+medico+" > "+date+" > "+manhaOUtarde+"</p>");
					$('#filtro-list').append("<p class='alert alert-danger'> Não é possível agendar consulta no turno da manhã para esse médico</p>");
				}
				
			}
			//Tarde
			if(turno == 2){
				if(data.object.afternoon == 1){
					$('#tableListConsultas').show();
					$('#filtro-list').append("<p class='alert alert-success'> "+esp+" > "+medico+" > "+date+" > "+manhaOUtarde+"</p>");
					$('#filtro-list').append("<p class='alert alert-success'>Paciente(s) agendado(s): "+consulta_qtd+"</p>");
					//
					if(consulta_qtd > 0){
						$.each(data.consultas, function (i, item) {
							$("#tableListConsultas").find("tbody#consultas-list").append("<tr id='paciente"+item.idpaciente+"'>{{-- id de cada registro --}}<th scope='row'>"+item.idpaciente+"</th><td class='text-center'>"+item.nome+"</td><td class='text-center'>"+item.cpf+"</td><td class='text-center'>"+item.convenio+"</td></tr>");
						});
					}
				}
				if(data.object.afternoon == 0){
					$('#filtro-list').append("<p class='alert alert-danger'> "+esp+" > "+medico+" > "+date+" > "+manhaOUtarde+"</p>");
					$('#filtro-list').append("<p class='alert alert-danger'> Não é possível agendar consulta no turno da tarde para esse médico</p>");
				}
			}
		}if(data.object.boolean == 0){
			$('#filtro-list').append("<p class='alert alert-danger'> "+esp+" > "+medico+" > "+date+" > "+manhaOUtarde+"</p>");
			$('#filtro-list').append("<p class='alert alert-danger'> Não é possível agendar consulta para esse médico nesta data.</p>");
		}
	}else{
		$('#filtro-list').append("<p class='alert alert-danger'> "+esp+" > "+medico+" > "+date+" > "+manhaOUtarde+"</p>");
		$('#filtro-list').append("<p class='alert alert-danger'> Indisponível.</p>");
	}
	})
	.fail(function(xhr) {
		console.log("request error 500");
	})
	.always(function() {
		console.log("complete");
	});
});

$(document).on('change', 'select#Imed', function(){
	$('select#Ihor').val($('#Ihor option[selected]').val());
});

$(document).on('change', 'input#Idata', function(){
	$('select#Ihor').val($('#Ihor option[selected]').val());
});

$(document).on('click', '#send-data', function(){
	$("tbody#pacientes-list").find('tr').remove();
	//input#Inome, input#Icpf, input#Inasc
	let dataForm = $('#form-search-paciente').serialize();
	let url = $('p#action-url').text();
	console.log(url);
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'json',
		data: dataForm,
	})
	.done(function(data) {
		$('#tableListPac').show();
		console.log("success:");
		console.log(data);
		let paciente_qtd = typeof data.length === 'undefined' ? 0 : data.length;
		if(paciente_qtd > 0){
			$.each(data, function (i, item) {
				$("#tableListPac").find("tbody#pacientes-list").append("<tr id='paciente"+item.idpaciente+"'><th scope='row' hidden=''>"+item.idpaciente+"</th><td class=''>"+item.nome+"</td><td class='text-center'>"+item.cpf+"</td><td class='text-center'>"+item.convenio+"</td> <td class='text-center'><div class='custom-control custom-radio'><input type='radio' class='custom-control-input' name='Npaciente' id='checkbox-paciente"+item.idpaciente+"' value='"+item.idpaciente+"'><label class='custom-control-label' for='checkbox-paciente"+item.idpaciente+"'></label></div></td></tr>");
			});
		}

	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
});

$(document).ready(function(){
    $('.custom-control-input').click(function() {
        $('.custom-control-input').not(this).prop('checked', false);
    });
});

$(document).on('click', '#submitAgendaConsulta', function(){
	let dataForm = $('#form-ajax-request-consulta').serialize();
	let url = $('#action-url-form-consulta').text();
	console.log(dataForm);
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'json',
		data: dataForm,
	})
	.done(function(data) {
		console.log("success");
		console.log(data.paciente);
		$("#tableListConsultas").find("tbody#consultas-list").append("<tr id='paciente"+data.paciente.idpaciente+"'>{{-- id de cada registro --}}<th scope='row'>"+data.paciente.idpaciente+"</th><td class='text-center'>"+data.paciente.nome+"</td><td class='text-center'>"+data.paciente.cpf+"</td><td class='text-center'>"+data.paciente.convenio+"</td></tr>");
		$("#tableListConsultas").find("tr#paciente"+data.paciente.idpaciente).css({'background-color':'rgba(110, 218, 103, 0.8)'});
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
});


{{-- </script>--}} {{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection