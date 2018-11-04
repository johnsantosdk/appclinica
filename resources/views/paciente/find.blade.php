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
					<div class="col">
						<div class="form-group">
							<button type="submit" class="btn btn-primary"> Pesquisar</button>
						</div>
					</div>
				</div>
				
			</form>
		
			{{-- $pacientes --}}
			@if(isset($pacientes))
				<div class="table-responsive">
	  				<table class="table" id="tableListPaciente">
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
								<tr id="paciente{{ $paciente->id }}">{{-- id de cada registro --}}
									<th scope="row">{{ $paciente->id }}</th>
									<td class="">{{ $paciente->nome }}</td>
									<td class="text-center">{{ $paciente->cpf }}</td>
									<td class="text-center">{{ $paciente->data_nascimento }}</td>
									<td class="text-center">
										<button type="button" 
												class="btn btn-success"
												data-toggle="modal"
			                                    data-target="#agendaPacienteModal"
			                                    data-id="{{$paciente->id}}"
			                                    data-nome="{{$paciente->nome}}"
												data-cpf="{{$paciente->cpf}}"
												data-nasc="{{ $paciente->data_nascimento }}"
			                                    id="tableAgendaButton">
										Agendar Consulta
										</button>

										<button type="button" 
												class="btn btn-info"
												data-toggle="modal"
			                                    data-target="#editPacienteModal"
			                                    data-id="{{$paciente->id}}"
			                                    data-nome="{{$paciente->nome}}"
												data-cpf="{{$paciente->cpf}}"
												data-nasc="{{ $paciente->data_nascimento }}"
			                                    id="tableEditButton">
										Editar
										</button>
										
										<button type="button" 
												class="btn btn-danger"
												data-toggle="modal"
			                                    data-target="#deletePacienteModal"
			                                    data-id="{{$paciente->id}}"
			                                    data-nome="{{$paciente->nome}}"
												data-status="{{$paciente->cpf}}"
												data-nasc="{{ $paciente->data_nascimento }}"
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
		//>>>BEGIN <<REQUEST FROM DATABASE>>
		//<<<END REQUEST FROM DATABASE

	    //>>>BEGIN <<EDIT MODAL>>
        $(document).on('click','#tableEditButton', function(){
            var id = $(this).data('id');

            $.post('{{ action('PacienteController@editPaciente') }}', {id:id}, function(data){
                console.log(data.length == 1);
                console.log(data.length == 2);
                console.log(data.length == 3);
                console.log(data[0].sexo == 'F');
                console.log(data)
                $('#editPacienteModal').find('#Iid').val(data[0].id);
                $('#editPacienteModal').find('#Inome').val(data[0].nome);
                $('#editPacienteModal').find('#Inasc').val(data[0].nascimento);
                if(data[0].sexo == 'F'){
                	$('#editPacienteModal').find('#IsexoF').prop('checked', true);
                }
                $('#editPacienteModal').find('#Icpf').val(data[0].cpf);
                $('#editPacienteModal').find('#Iemail').val(data[0].email);
                if(data.length == 1){
                	if(data[0].tipo == 'RES'){
						$('#editPacienteModal').find('#ItelR').val(data[0].numero);
                	}if(data[0].tipo == 'EMP'){
						$('#editPacienteModal').find('#ItelE').val(data[0].numero);
                	}if(data[0].tipo == 'CEL'){
						$('#editPacienteModal').find('#ItelC').val(data[0].numero);
                	}
            	}if(data.length == 2){
                	if(data[0].tipo == 'RES'){
						$('#editPacienteModal').find('#ItelR').val(data[0].numero);
                	}if(data[0].tipo == 'EMP'){
						$('#editPacienteModal').find('#ItelE').val(data[0].numero);
                	}if(data[0].tipo == 'CEL'){
						$('#editPacienteModal').find('#ItelC').val(data[0].numero);
                	}
                	if(data[1].tipo == 'RES'){
						$('#editPacienteModal').find('#ItelR').val(data[1].numero);
                	}if(data[1].tipo == 'EMP'){
						$('#editPacienteModal').find('#ItelE').val(data[1].numero);
                	}if(data[1].tipo == 'CEL'){
						$('#editPacienteModal').find('#ItelC').val(data[1].numero);
                	}					
            	}
            	if(data.length == 3){
                	if(data[0].tipo == 'RES'){
						$('#editPacienteModal').find('#ItelR').val(data[0].numero);
                	}if(data[0].tipo == 'EMP'){
						$('#editPacienteModal').find('#ItelE').val(data[0].numero);
                	}if(data[0].tipo == 'CEL'){
						$('#editPacienteModal').find('#ItelC').val(data[0].numero);
                	}
                	if(data[1].tipo == 'RES'){
						$('#editPacienteModal').find('#ItelR').val(data[1].numero);
                	}if(data[1].tipo == 'EMP'){
						$('#editPacienteModal').find('#ItelE').val(data[1].numero);
                	}if(data[1].tipo == 'CEL'){
						$('#editPacienteModal').find('#ItelC').val(data[1].numero);
                	}
                	if(data[2].tipo == 'RES'){
						$('#editPacienteModal').find('#ItelR').val(data[2].numero);
                	}if(data[2].tipo == 'EMP'){
						$('#editPacienteModal').find('#ItelE').val(data[2].numero);
                	}if(data[2].tipo == 'CEL'){
						$('#editPacienteModal').find('#ItelC').val(data[2].numero);
                	}					
            	}
                $('#editPacienteModal').find('#IplanoId').val(data[0].plano_id);
                $('#editPacienteModal').find('#Imat').val(data[0].matricula);   
                $('#form-edit-plano').show();
                $('.modal-title').text('Editar Plano');
            });
        });
		$('#editPacienteModal').on('hidden.bs.modal', function () {
    		window.alert('hidden event fired!');
		});
    //<<<END <<EDIT MODAL>>
{{-- </script> --}}{{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection