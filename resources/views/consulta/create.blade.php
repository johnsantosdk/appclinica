@extends('layouts.app')

@section('title', 'Registro de Consulta')

@section('content')

<div class="container">

	<div class='row'>
		<div class="col-sm-6">
			<h2>AGENDAR</h2>
			<form action="" id="form-ajax-request-consulta">
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
			</form>
			<form action="{{--  --}}" method="post" ajax="true">
				{{ csrf_field() }}
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
				<div class="">
					<div class="form-group">
						<button type="submit" class="btn btn-primary" id="searchSubmit"> Pesquisar</button>
					</div>
				</div>
			</form>
			@if(isset($pacientes) && count($pacientes) == 0)
				<div class="alert alert-info" id="testFade">
	  				<strong>Sem resultas!</strong> Nenhum resultado encontrado para os dados informados acima.
				</div>
			@endif
				{{-- <div class="table-responsive">
	  				<table class="table" id="tableListPac" hidden="true">
	  					<div><p><strong>Total</strong>: N cadastro(s)</p></div> 
						<thead class="">
							<tr>
								<th scope="col">ID</th>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">CPF</th>
								<th scope="col" class="text-center">Convênio</th>
							</tr>
						</thead>
						<tbody id="pacientes-list">
								<tr id="paciente">
									<th scope="row"></th>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>	
								</tr>
						</tbody>
						<tfooter>
							<tr>
								<th scope="col" class="">ID</th>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">CPF</th>
								<th scope="col" class="text-center">Convênio</th>
							</tr>
						</tfooter>
	  				</table>
				</div> --}}
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
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">CPF</th>
								<th scope="col" class="text-center">Convênio</th>
							</tr>
						</thead>
						<tbody id="pacientes-list">

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
//Filtra os médicos ao escolher a especialidade
$(document).on('change', 'select#Iesp', function(){
	let id = $(this).children("option:selected").val();
	$("#form-ajax-request-consulta").find("#Imed").empty();
	console.log("value before: "+id);
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

	console.log('Médico: '+id+' Data: '+date+' Hora: '+turno);
	$.ajax({
		type: 'POST',
		url: '{{ route('consulta.filtro') }}',
		dataType: 'json',
		data: {id:id, date: date, turno: turno},
	})
	.done(function(data) {
		console.log(data);
		$('#filtro-list').find('p').remove();
		$("tbody#pacientes-list").find('tr').remove();
		//
		if(data.object.boolean == 1){
			let consulta_qtd = data.consultas.length;
			//
			$('#filtro-list').append("<p class='alert alert-success'> "+esp+" > "+medico+" > "+date+" > "+manhaOUtarde+"</p>");
			$('#filtro-list').append("<p class='alert alert-success'>Paciente(s) agendado(s): "+consulta_qtd+"</p>");
			//
			if(consulta_qtd > 0){
				{{-- $("#tableListConsultas").hidden('false'); --}}
				$.each(data.consultas, function (i, item) {
					$("#tableListConsultas").find("tbody#pacientes-list").append("<tr id='paciente"+item.idpaciente+"'>{{-- id de cada registro --}}<th scope='row'>"+item.idpaciente+"</th><td class='text-center'>"+item.nome+"</td><td class='text-center'>"+item.cpf+"</td><td class='text-center'>"+item.convenio+"</td></tr>");
				});
			}
		}if(data.object.boolean == 0){
			$('#filtro-list').append("<p class='alert alert-danger'> "+esp+" > "+medico+" > "+date+" > "+manhaOUtarde+"</p>");
			$('#filtro-list').append("<p class='alert alert-danger'> Não é possível agendar consulta para esse médico nesta data.</p>");
		}


	})
	.fail(function(xhr) {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
	console.log(date);
});

$(document).on('change', 'select#Imed', function(){
	$('select#Ihor').val($('#Ihor option[selected]').val());
});

{{-- </script>--}} {{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection