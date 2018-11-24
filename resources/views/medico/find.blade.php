@extends('layouts.app')

@section('title', 'Lista de Médicos')

@section('content')
<div class="container">
	<div class='row'>
		<div class="col-sm-10">
			<div id="alertDeletetPaciente">
				
			</div>
			<form action="{{ route('medico.list') }}" method="post">
				{{ csrf_field() }}
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="Iesp">Especialidade</label>
							<select class="form-control" name="" id="">
								<option value="">Ortpedia/Traumatologia</option>
								<option value="">Clínico Geral</option>
							</select>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="Inome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control" value="{{ old('Nnome') }}">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="Icpf">CRM:</label>
							<input type="text" id="Icpf" name="Ncpf" class="form-control" placeholder="">
						</div>
					</div>
				</div>
				<div class="">
					<div class="form-group">
						<button type="submit" class="btn btn-primary" id="searchSubmit"> Pesquisar</button>
					</div>
				</div>
			</form>
			@if(isset($medicos) && count($medicos) == 0)
				<div class="alert alert-info" id="testFade">
	  				<strong>Sem resultas!</strong> Nenhum resultado encontrado para os dados informados acima.
				</div>
			@endif
			@if(isset($medicos) && (count($medicos) > 0))
				<div class="table-responsive">
	  				<table class="table" id="tableListMedicos">
	  					<div><p><strong>Total</strong>: {{ count($medicos) }} cadastro(s)</p></div> 
						<thead class="">
							<tr>
								<th scope="col">ID</th>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">CRM</th>
								<th scope="col" class="text-center">Ação</th>
							</tr>
						</thead>
						<tbody id="medicos-list">
							@foreach ($medicos as $medico)
								<tr id="medico{{ $medico->idmedico }}">{{-- id de cada registro --}}
									<th scope="row">{{ $medico->idmedico }}</th>
									<td class="">{{ $medico->nome }}</td>
									<td class="text-center">{{ $medico->crm }}</td>
									<td class="text-center">

										<button type="button" 
												class="btn btn-info"
												data-toggle="modal"
			                                    data-target="#editMedicoModal"
			                                    data-id="{{$medico->idmedico}}"
			                                    data-nome="{{$medico->nome}}"
												data-cpf="{{$medico->crm}}"
			                                    id="tableEditButton">
										Editar
										</button>
										
										<button type="button" 
												class="btn btn-danger"
												data-toggle="modal"
			                                    data-target="#deleteMedicoModal"
			                                    data-id="{{$medico->idmedico}}"
			                                    data-nome="{{$medico->nome}}"
												data-status="{{$medico->crm}}"
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
								<th scope="col" class="text-center">CRM</th>
								<th scope="col" class="text-center">Ação</th>
							</tr>
						</tfooter>
	  				</table>
				</div>
			@endif
		</div>
	</div>
	{{--  
	@if(isset($medicos) && count($medicos) > 1)
		<div class="text-center">
	        {{   $medicos->links() }}
	    </div>
	@endif
	--}}
</div>
@endsection