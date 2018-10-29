@extends('layouts.app')

@section('title', 'Registro de Planos')

@section('head')

@endsection

@section('content')

<div class="container">

	<div class='row'>
		<div class="col-sm-10">
			<form action="{{ action('PlanoController@store') }}" method="GET" class="form-createPlano">
				{{ csrf_field() }}
				<fieldset>
					<legend>Plano</legend>
					<div class="form-group">
						<label for="Inome">Nome:</label>
						<input type="text" id="Inome" name="Nnome" class="form-control" style="text-transform:uppercase" autofocus>
					</div>
					<div class="form-group">
						<label for="Istatus">Status:</label>
						<select id="Istatus" name="Nstatus" class="form-control" placeholder="Status do Plano">
							<option value=""></option>
							<option value="{{ 1 }}" class="optionTrue">Ativo</option>
							<option value="{{ 0 }}" class="optionFalse">Suspenso</option>
						</select>
					</div>
				</fieldset>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		
			<div class="table-responsive">
  				<table class="table" id="tableCreatePlano">
					<thead class="">
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Plano</th>
							<th scope="col">Status</th>
							<th scope="col">Ação</th>
						</tr>
					</thead>
					<tbody id="planos-list">
						@foreach ($planos as $plano)
							<tr id="plano{{ $plano->id }}">
								<th scope="row">{{ $plano->id}}</th>
								<td>{{ $plano->nome }}</td>
								@if ($plano->status_plano == 1)
								 	<td class="statusTrue">ATIVO</td>
								@else
									<td class="statusFalse">SUSPENSO</td>
								@endif
								<td>
									<button type="button" 
											class="btn btn-info"
											data-toggle="modal"
		                                    data-target="#editPlanoModal"
		                                    data-id="{{$plano->id}}"
		                                    data-nome="{{$plano->nome}}"
											data-status="{{$plano->status_plano}}"
		                                    id="tableEditButton">
									Editar
									</button>
									
									<button type="button" 
											class="btn btn-danger"
											data-toggle="modal"
		                                    data-target="#deletePlanoModal"
		                                    data-id="{{$plano->id}}"
		                                    data-nome="{{$plano->nome}}"
											data-status="{{$plano->status_plano}}"
		                                    id="tableDeleteButton">
									Deletar
									</button>
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfooter>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Plano</th>
						</tr>
					</tfooter>
  				</table>
			</div>
		</div>
	</div>
		<div class="centralizado">
            <p>{{   $planos->links() }}</p>
        </div>
</div>
{{-- includes de modals --}}
{{-- Modal edit --}}
@include('plano.modals.modal_edit_plano')
{{-- Modal delete --}}
@include('plano.modals.modal_delete_plano')
@endsection

@section('script')

@endsection