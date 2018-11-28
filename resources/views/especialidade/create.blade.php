@extends('layouts.app')

@section('title', 'Cadastro')

@section('content')
<div class="container">
	<div class='row'>
		    @if (Session::has('flash_message'))
		        <div class="container">
		            <div class="row">
		                <div class="col-md-10 col-md-offset-1">
		                    <div align="center" class="alert {{Session::get('flash_message')['class']}}">
		                        {{ Session::get('flash_message')['msg'] }}
		                    </div>
		                </div>
		            </div>
		        </div>
    		@endif
		<div class="col-sm-10">
			<form action="{{ route('especialidade.store') }}" method="post">
				{{ csrf_field() }}
					<fieldset>
						<legend>Especialidade</legend>
						<div class="form-group" {{ $errors->has('Nnome') ? 'has-error' : ''}}>
							<label for="Inome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control" value="{{ old('Nnome') }}">
							{!! $errors->first('Nnome', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
						<div class="form-group" {{ $errors->has('Ncbo') ? 'has-error' : ''}}>
							<label for="Icbo">CBO:</label>
							<input type="number" id="Icbo" name="Ncbo" class="form-control" value="{{ old('Ncbo') }}">
							{!! $errors->first('Ncbo', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
					<!-- ID do usuário que está fazendo o cadastro-->
					<div class="form-group" >
						<input type="number" id="IidAten" name="NidAten" value="1" hidden>
					</div>
				</fieldset>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		@if(isset($especialidades))
			<hr>{{--  <p>CBO(s) cadastrados: <strong>{{ count($especialidades) }}</strong> </p>--}}
			<div class="table-responsive">
  				<table class="table" id="tableCreateEspecialidade">
					<thead class="">
						<tr>
							<th scope="col">ID</th>
							<th class="text-center" scope="col">CBO</th>
							<th class="text-center" scope="col">Descrição</th>
						</tr>
					</thead>
					<tbody id="especialidades-list">
						@foreach ($especialidades as $especialidade)
							<tr id="especialidade{{ $especialidade->idespecialidade }}">
								<th scope="row">{{ $especialidade->idespecialidade}}</th>
								<td>{{ $especialidade->cbo }}</td>
								<td>{{ $especialidade->nome }}</td>
								<td>
									<button type="button" 
											class="btn btn-info"
											data-toggle="modal"
		                                    data-target="#editEspecialidadeModal"
		                                    data-id="{{$especialidade->idespecialidade}}"
		                                    data-nome="{{$especialidade->cbo}}"
											data-status="{{$especialidade->nome}}"
		                                    id="tableEditButton">
									Editar
									</button>
									
									<button type="button" 
											class="btn btn-danger"
											data-toggle="modal"
		                                    data-target="#deleteEspecialidadeoModal"
		                                    data-id="{{$especialidade->idespecialidade}}"
		                                    data-nome="{{$especialidade->nome}}"
											data-status="{{$especialidade->status}}"
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
							<th class="text-center" scope="col">CBO</th>
                            <th class="text-center" scope="col">Descrição</th>
                            <th class="text-center" scope="col">Ação</th>
						</tr>
					</tfooter>
  				</table>
			</div>
		@endif
		</div>
		</div>
			<div class="text-center">
	            <p>{{   $especialidades->links() }}</p>
	        </div>
		</div>
		</div>
	</div>
</div>
@endsection