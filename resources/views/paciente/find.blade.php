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
			                                    data-target="#editPacienteModal"
			                                    data-id="{{$paciente->id}}"
			                                    data-nome="{{$paciente->nome}}"
												data-cpf="{{$paciente->cpf}}"
												data-nasc="{{ $paciente->data_nascimento }}"
			                                    id="tableEditButton">
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
								<th scope="col" class="text-center">ID</th>
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
{{-- Modal delete
@include('paciente.modals.modal_delete_plano') --}}
@endsection