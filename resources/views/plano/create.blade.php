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
			<form action="{{ action('PlanoController@store') }}" method="GET">
				{{ csrf_field() }}
				<fieldset>
					<legend>Plano</legend>
					<div class="form-group">
						<label for="Inome">Nome:</label>
						<input type="text" id="Inome" name="Nnome" class="form-control" style="text-transform:uppercase">
					</div>
					<div class="form-group">
						<label for="Istatus">Status:</label>
						<select id="Istatus" name="Nstatus" class="form-control">
							<option value="1">Atendendo</option>
							<option value="0">Suspenso</option>
						</select>
					</div>
				</fieldset>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		
			<div class="table-responsive">
  				<table class="table">
					<thead class="">
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Plano</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($planos as $plano)
							<tr id="{{ $plano->id }}">
								<th scope="row">{{ $plano->id}}</th>
								<td>{{ $plano->nome }}</td>
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

@endsection

@section('script')
	


@endsection