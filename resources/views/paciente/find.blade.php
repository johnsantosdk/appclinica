@extends('layouts.app')

@section('title', 'Pesquisa\\Agendamento\\Edição\\Deleção de Cadastros')

@section('content')

<div class="container">
	<div class='row'>
		<div class="col-sm-10">
			<div id="alertDeletetPaciente">
				
			</div>
			<form action="{{ route('paciente.listPaciente') }}" method="post" class="bg-and-color-text-form">
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
						<button type="submit" class="btn btn-primary float-right" id="searchSubmit"> Pesquisar</button>
					</div>
				</div>
				<br><br>
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
	{{-- --}} 
	@if(isset($pacientes) && count($pacientes) > 1)
		<div class="text-center">
	        {{   $pacientes->links() }}
	    </div>
	@endif
	
</div>

{{-- includes de modals --}}
{{-- Modal edit --}}
@include('paciente.modals.modal_edit_paciente')
{{-- Modal delete--}}
@include('paciente.modals.modal_delete_paciente')
{{-- Modal Agendamento de Paciente --}} 
@include('paciente.modals.modal_agenda_paciente') 
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
			$('#paciente-success').hide(1000);
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
                if(data[0].sexo == 'femenino' || data[0].sexo == 'FEMENINO'){
                	$('#editPacienteModal').find('#Isexo').val("femenino");
                }if(data[0].sexo == 'masculino' || data[0].sexo == 'MASCULINO'){
					$('#editPacienteModal').find('#Isexo').val("masculino");
            	}
            	//
                $('#editPacienteModal').find('#IidPlan').val(data[0].planoid);
                $('#editPacienteModal').find('#Icpf').val(data[0].cpf).mask('000.000.000-00');
                if(data[0].email == null){
					$('#editPacienteModal').find('#Iemail').val();
            	}else{
					$('#editPacienteModal').find('#Iemail').val(data[0].email);
            	}
                
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
                    //console.log(data);
             		$('#editPacienteModal').show().scrollTop(0);
                    $('#paciente-success').show("slow");
                    
                },
                error: function(xhr)
                {
					//console.log(xhr);
                     //1 - Procurar o campo que tem erro de validação
                     //2 - Inseri o texto de error logo abaixo do campo
                     $.each(xhr.responseJSON.errors, function(key,value) {
                        $('#'+key+'-error').append('<p class="help-block alert alert-danger">'+value+'</p>');
                    });

            	}
            });
            $('p.help-block').remove();
        });
    //<<<END <<UPDATE MODAL>>
    //>>>BEGIN <<SHOW MODAL DELETE>>
        $(document).on('click', '#tableDeleteButton', function(){
            var id = $(this).data('id');
            $('#deletePacienteModal').find('#modalReplace').replaceWith('<div class="modal-body" id="modalReplace"><p id="deleteModalId"></p><p id="deleteModalNome"></p><p id="deleteModalNasc"></p><p id="deleteModalCpf"></p><p id="deleteModalEmail"></p></div>');
			console.log('id = '+id+' antes de exluir');
            $.post('{{ route('paciente.showPaciente') }}', {id:id}, function(data){
                $('#deletePacienteModal').find('input#Iid').val(data.idpaciente);
                $('#deletePacienteModal').find('p#deleteModalId').html('<strong style="font-size:18px">ID:</strong> '+data.idpaciente);
                $('#deletePacienteModal').find('p#deleteModalNome').html('<strong style="font-size:18px">Nome:</strong> '+data.nome);
                $('#deletePacienteModal').find('p#deleteModalNasc').html('<strong style="font-size:18px">Data Nascimento:</strong> '+data.nascimento);
                $('#deletePacienteModal').find('p#deleteModalCpf').html('<strong style="font-size:18px">CPF:</strong> '+data.cpf);
                if(data.email != null){
					$('#deletePacienteModal').find('p#deleteModalCpf').html('<strong style="font-size:18px">E-mail:</strong> '+data.email);
            	}
                
                //------------------------------------------------------------------
                $('.modal-body').show();
                $('.modal-title').text('Deletar Paciente');
                               console.log(data);
                });
        });
    //<<<END <<SHOW MODAL DELETE>>
    //>>>BEGIN <<DELETE PLANO NODEL>>
        $("#deleteButtonModalPaciente").click(function(){
            $.ajax({
                type : 'POST',
                url  : '{{ action('PacienteController@destroyPaciente') }}',
                datatype: 'json',
                data : $("#form-delete-paciente").serialize(),
                success: function(data)
                {
                	console.log('Dados vindo do controller'+ data);
                	$('#deletePacienteModal').find('#modalReplace').replaceWith('<div class="modal-body" id="modalReplace"><p class="help-block alert alert-success text-center">Registro deletado com <strong>SUCESSO!</strong></p></div>');
                    $('tr#paciente'+data).remove();
                    //$('#closeModal').trigger('click');
                },
                errors: function(xhr)
                {
                    console.log("FAIL");
                    $('#deletePacienteModal').find('#modalReplace').replaceWith('<p class="help-block alert alert-info text-center"><strong>OPS!</strong> Algo de errado aconteceu. O registro não foi deletado. Contate o <strong>SUPPORT</strong></p>');
                }
            })
            //location.reload();
        });
    //<<<END <<DELETE PLANO NODEL>>
{{-- </script> --}}{{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection
