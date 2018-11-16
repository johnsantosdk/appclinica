<!-- Modal Edit-->
<div class="modal fade" id="editPacienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-edit-css">
        <h5 class="modal-title" id="editPacienteLabel">Editar Cadastro de Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			{{-- Form de visulalização e edição --}}
			<form action="{{ route('paciente.updatePaciente') }}" class="form-horizontal" role="form" id="form-edit-paciente">
				{{ csrf_field() }}
					<fieldset>
						<legend>Dados do Paciente</legend>
						<div class="form-group" {{ $errors->has('Nnome') ? 'has-error' : ''}}>
							<label for="Inome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control" value="" >
							{!! $errors->first('Nnome', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>

						<div class="form-group" {{ $errors->has('Nnasc') ? 'has-error' : ''}}>
							<label for="Inasc">Nascimento:</label>
							<input type="date" id="Inasc" name="Nnasc" class="form-control" value="">
							{!! $errors->first('Nnasc', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
						<div class="form-group" {{ $errors->has('Nsexo') ? 'has-error' : ''}}>
							<label for="Isexo">Sexo:</label>
							<select name="Nsexo" id="Isexo" class="form-control">
								<option value=""></option>
								<option value="masculino">Masculino</option>
								<option value="femenino">Femenino</option>
							</select>
							{!! $errors->first('Nsexo', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
						<div class="form-group" {{ $errors->has('Ncpf') ? 'has-error' : ''}}>
							<label for="Icpf">CPF:</label>
							<input type="text" id="Icpf" name="Ncpf" class="form-control" value="">
							{!! $errors->first('Ncpf', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>

						<div class="form-group" {{ $errors->has('Nemail') ? 'has-error' : ''}}>
							<label for="Iemail">E-mail</label>
							<input type="email" id="Iemail" name="Nemail" class="form-control" value="" >
							{!! $errors->first('Nemail', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
						<hr>  
						<fieldset>
							<legend>Telefones:</legend> 
							<div class="form-group">
								<div class="form-group" {{ $errors->has('NtelR') ? 'has-error' : ''}}>
									<label for="ItelR">Residencial:</label>
									<input type="text" id="ItelR" name="NtelR" class="form-control has-error" placeholder="type here..." value="" >
									{!! $errors->first('NtelR', '<p class="help-block alert alert-danger">:message</p>') !!}
								</div>
								<div class="form-group" {{ $errors->has('NtelE') ? 'has-error' : ''}}>
									<label for="ItelE">Empresarial:</label>
									<input type="text" id="ItelE" name="NtelE" class="form-control bfh-phone" placeholder="type here..." value="">
									{!! $errors->first('NtelE', '<p class="help-block alert alert-danger">:message</p>') !!}
								</div>
								<div class="form-group" {{ $errors->has('NtelC') ? 'has-error' : ''}}>
									<label for="ItelC">Celular:</label>
									<input type="text" id="ItelC" name="NtelC" class="form-control" placeholder="type here..." value="">
									{!! $errors->first('NtelC', '<p class="help-block alert alert-danger">:message</p>') !!}
								</div>
							</div>
						<fieldset>
						<legend>Dados do Plano de Saúde</legend>
						<div class="form-group" {{ $errors->has('NplanoId') ? 'has-error' : ''}}>
							<label for="IplanoId">Plano:</label>
							<select id="IplanoId" name="NplanoId" class="form-control">
								{{ $i = 0 }}
								<option value=""></option>
								@if(isset($planos))
									@foreach($planos as $plano)
										<option value="{{ $plano->idplano}}">{{ ++$i }} - {{ $plano->nome }}</option>
									@endforeach
								@endif
							</select>
							{!! $errors->first('NplanoId', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
						<div class="form-group" {{ $errors->has('Nmat') ? 'has-error' : ''}}>
							<label for="Imat">Matricula:</label>
							<input type="text" id="Imat" name="Nmat" class="form-control" value="">
							{!! $errors->first('Nmat', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
					</fieldset>
					

					<!-- ID do usuário que está fazendo o cadastro-->
					<div class="form-group" >
						<input type="number" id="IidPaci" name="NidPaci" value="" hidden>
						{{--  <input type="number" id="IidConv" name="NidConv" value="" hidden>
						<input type="number" id="IidTelR" name="NidTelR" value="" hidden>
						<input type="number" id="IidTelE" name="NidTelE" value="" hidden>
						<input type="number" id="IidTelC" name="NidTelC" value="" hidden>
						<input type="number" id="IidPlan" name="NidPlan" value="" hidden>--}}
						<input type="number" id="IidAten" name="NidAten" value="1" hidden>
					</div>
				</fieldset>
				
				<!--<button type="submit" class="btn btn-primary">Registrar</button>-->
				</form>			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="buttonSubmitFormPaciente">Update</button>
        {{--<input type="submit" class="btn btn-primary" value="Salvar">--}}
      </div>
    </div>
  </div>
</div>
