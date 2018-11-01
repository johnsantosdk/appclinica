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
							<label for="Nnome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="Ncpf">CPF:</label>
							<input type="text" id="Icpf" name="Ncpf" class="form-control">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="Nnasc">Data Nascimento:</label>
							<input type="date" id="Inasc" name="Nnasc" class="form-control">
						</div>
					</div>
				</div>
				

				
				<button type="submit" class="btn btn-primary"> Pesquisar</button>
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
								<th scope="col" class="text-center">Contato</th>
								<th scope="col" class="text-center">Ação</th>
							</tr>
						</thead>
						<tbody id="pacientes-list">
							@foreach ($pacientes as $paciente)
								<tr id="paciente{{ $paciente->id }}">{{-- id de cada registro --}}
									<th scope="row">{{ $paciente->id }}</th>
									<td class="text-center">{{ $paciente->nome }}</td>
									<td class="text-center">{{ $paciente->cpf }}</td>
									<td class="text-center">NULL{{-- $paciente->contato --}}</td>
									<td class="text-center">
										<button type="button" 
												class="btn btn-success"
												data-toggle="modal"
			                                    data-target="#editPacienteModal"
			                                    data-id="{{$paciente->id}}"
			                                    data-nome="{{$paciente->nome}}"
												data-cpf="{{$paciente->cpf}}"
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
								<th scope="col" class="text-center">Contato</th>
								<th scope="col" class="text-center">Ação</th>
							</tr>
						</tfooter>
	  				</table>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection