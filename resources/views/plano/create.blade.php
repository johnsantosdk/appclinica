@extends('layouts.app')

@section('title', 'Registro de Planos')

@section('head')

@endsection

@section('content')

<div class="container">

	<div class='row'>
		<div class="col-sm-10">
			@if ($errors->any())
    			<div class="alert alert-danger">
        			<ul>
            			@foreach ($errors->all() as $error)
                			<li>{{ $error }}</li>
            			@endforeach
        			</ul>
    			</div>
    		@endif
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
							<option value="{{ 1 }}" class="optionTrue">Atendendo</option>
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
								 	<td class="statusTrue">ATENDENDO</td>
								@else
									<td class="statusFalse">SUSPENSO</td>
								@endif
								<td>
									<a href="">
										<button type="button" 
												class="btn btn-info"
												data-toggle="modal"
		                                        data-target="#editPlanoModal"
		                                        data-id="{{$plano->id}}"
		                                        data-nome="{{$plano->nome}}"
												data-status="{{$plano->status}}"
		                                        id="edit">
									    	Editar
										</button>
									</a>

									<a href=""><button type="button" class="btn btn-danger">Deletar</button></a>
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
{{-- Modal edit --}}
@include('plano.modals.modal_edit_plano')
@endsection

@section('script')

@endsection