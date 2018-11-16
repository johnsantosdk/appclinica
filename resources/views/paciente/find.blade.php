@extends('layouts.app')

@section('title', 'Editando Cadastro')

@section('content')

<div class="container">
	<div class='row'>
		<div class="col-sm-10">
			<form action="{{ route('paciente.listPaciente') }}" method="post">
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
							<input type="text" id="Icpf" name="Ncpf" class="form-control">
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
			@if(isset($pacientes) && (count($pacientes) > 0))
				<div class="table-responsive">
	  				<table class="table" id="tableListPaciente">
	  					<div><p><strong>Total</strong>: {{ count($pacientes) }} cadastro(s)</p></div> 
						<thead class="">
							<tr>
								<th scope="col">ID</th>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">CPF</th>
								<th scope="col" class="text-center">Data Nascimento</th>
								<th scope="col" class="text-center">Ação</th>
							</tr>
						</thead>
						<tbody id="pacientes-list">
							@foreach ($pacientes as $paciente)
								<tr id="paciente{{ $paciente->idpaciente }}">{{-- id de cada registro --}}
									<th scope="row">{{ $paciente->idpaciente }}</th>
									<td class="">{{ $paciente->nome }}</td>
									<td class="text-center">{{ $paciente->cpf }}</td>
									<td class="text-center">{{ $paciente->nascimento }}</td>
									<td class="text-center">
										<button type="button" 
												class="btn btn-success"
												data-toggle="modal"
			                                    data-target="#agendaPacienteModal"
			                                    data-id="{{$paciente->idpaciente}}"
			                                    data-nome="{{$paciente->nome}}"
												data-cpf="{{$paciente->cpf}}"
												data-nasc="{{ $paciente->nascimento }}"
			                                    id="tableAgendaButton">
										Agendar Consulta
										</button>

										<button type="button" 
												class="btn btn-info"
												data-toggle="modal"
			                                    data-target="#editPacienteModal"
			                                    data-id="{{$paciente->idpaciente}}"
			                                    data-nome="{{$paciente->nome}}"
												data-cpf="{{$paciente->cpf}}"
												data-nasc="{{ $paciente->nascimento }}"
			                                    id="tableEditButton">
										Editar
										</button>
										
										<button type="button" 
												class="btn btn-danger"
												data-toggle="modal"
			                                    data-target="#deletePacienteModal"
			                                    data-id="{{$paciente->idpaciente}}"
			                                    data-nome="{{$paciente->nome}}"
												data-status="{{$paciente->cpf}}"
												data-nasc="{{ $paciente->nascimento }}"
			                                    id="tableDeleteButton">
										Deletar
										</button>
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfooter>
							<tr>
								<th scope="col" class="">ID</th>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">CPF</th>
								<th scope="col" class="text-center">Data Nascimento</th>
								<th scope="col" class="text-center">Ação</th>
							</tr>
						</tfooter>
	  				</table>
				</div>
			@endif
		</div>
	</div>
	{{--  
	@if(isset($pacientes))
		<div class="text-center">
	        {{   $pacientes->links() }}
	    </div>
	@endif
	--}}
</div>

{{-- includes de modals --}}
{{-- Modal edit --}}
@include('paciente.modals.modal_edit_paciente')
{{-- Modal delete--}}
@include('paciente.modals.modal_delete_paciente') 
@endsection

@section('customer-javaScript')

{{-- <script> <script>--}}{{-- RETIRE O COMENTÁRIO DA TAG <SCRIPT> PARA VISUALIZAR O CÓDIGO COLORIDO --}} 
	$("#searchSubmit").click(function(){
        $("#testFade").fadeOut(1000)
    });
		//>>>BEGIN <<REQUEST FROM DATABASE>>
		//<<<END REQUEST FROM DATABASE

	    //>>>BEGIN <<EDIT MODAL>>
        $(document).on('click','#tableEditButton', function(){
            var id = $(this).data('id');

            $.post('{{ action('PacienteController@editPaciente') }}', {id:id}, function(data){
                    //MASKARAS
				    //$('#editPacienteModal').find('#Icpf').mask('000.000.000-00');
				    //Mascara para telefone fixo
				    $('#editPacienteModal').find('#ItelR').mask('(00)0000-0000');
				    $('#editPacienteModal').find('#ItelE').mask('(00)0000-0000');
				    //Máscara para telefone celular
				    $('#editPacienteModal').find('#ItelC').mask('(00)00000-0000');
               console.log(data)
                //LIMPA O FORMULÁRIO ANTES DE INSERIR AS INFORMAÇÕES
                $(':input','#form-edit-paciente')
  				.not(':button, :submit, :reset, :hidden')
  				.val('')
  				.removeAttr('selected');
  				//INSERÇÃO DOS DADOS NO DEVIDOS CAMPOS/INPUTS
                $('#editPacienteModal').find('#IidPaci').val(data[0].idpaciente);
                $('#editPacienteModal').find('#Inome').val(data[0].nome);
                $('#editPacienteModal').find('#Inasc').val(data[0].nascimento);
                //
                if(data[0].sexo == 'femenino'){
                	$('#editPacienteModal').find('#Isexo').val("femenino");
                }if(data[0].sexo == 'masculino'){
					$('#editPacienteModal').find('#Isexo').val("masculino");
            	}
            	//
                $('#editPacienteModal').find('#IidPlan').val(data[0].planoid);
                $('#editPacienteModal').find('#Icpf').val(data[0].cpf).mask('000.000.000-00');
                $('#editPacienteModal').find('#Iemail').val(data[0].email);
				//TRATAMENTO PARA INSERIR OS DADOS DE CONTATOS CORRETAMENTE
					for (var i = 0; i < data.length; i++) {
					    if((data[i].tipo != null) && (data[i].numero != null)) {
					        if(data[i].tipo == 'RES'){
					            $('#editPacienteModal').find('#ItelR').val(data[i].numero).mask('(00)0000-0000');
					        }if(data[i].tipo == 'EMP'){
					            $('#editPacienteModal').find('#ItelE').val(data[i].numero).mask('(00)0000-0000');
					        }if(data[i].tipo == 'CEL'){
					            $('#editPacienteModal').find('#ItelC').val(data[i].numero).mask('(00)00000-0000');
					        }
					    }
					}
				//
                $('#editPacienteModal').find('#IplanoId').val(data[0].planoid);
                $('#editPacienteModal').find('#Imat').val(data[0].matricula);   
                $('#form-edit-plano').show();
                $('.modal-title').text('Editar Plano');
            });
        });

    //<<<END <<EDIT MODAL>>

    //>>>BEGIN <<UPDATE MODAL>>
        $('#buttonSubmitFormPaciente').click(function(){
            var formData = $('#form-edit-paciente').serialize();
            $.ajax({
                type : 'POST',
                url  : '{{ route('paciente.updatePaciente') }}',
                datatype: 'json',
                data: formData,
                success: function(data)
                { 
                    console.log(data);
                },
                error: function(xhr)
                {
					var errs = xhr.responseJSON.errors; 
					console.log(errs);
					
				$.each(errs, function (){
					console.log(text(val[0]));
				});

            	}

            });

        });
    //<<<END <<UPDATE MODAL>>
{{-- </script> --}}{{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection