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
			<form action="{{ route('paciente.update') }}" class="form-horizontal" role="form" id="form-edit-paciente">
				{{ csrf_field() }}
					<fieldset>
						<legend>Dados do Paciente</legend>
						<div class="form-group">
							<label for="Inome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control" value="">
						</div>

						<div class="form-group">
							<label for="Inasc">Nasc.:</label>
							<input type="date" id="Inasc" name="Nnasc" class="form-control" value="">
						</div>
						<div class="form-group">
							Sexo:
							<div class="form-check">
								<input class="form-check-input" type="radio" name="Nsexo" id="IsexoM"  value="" checked>
								<label class="form-check-label" for="IsexoM">
							    	Masculino
							  	</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="Nsexo" id="IsexoF" value="">
								<label class="form-check-label" for="IsexoF">
							    	Femenino
							  	</label>
							</div>
						</div>
						<div class="form-group">
							<label for="Icpf">CPF:</label>
							<input type="text" id="Icpf" name="Ncpf" class="form-control" value="">
						</div>

						<div class="form-group">
							<label for="Iemail">E-mail</label>
							<input type="email" id="Iemail" name="Nemail" class="form-control" value="">
						</div>
						<hr>
						{{--  
						<fieldset>
							<legend>Telefones:</legend> 
							<div class="form-group">
								<div>
									<label for="ItelR">Residencial:</label>
									<input type="text" id="ItelR" name="NtelR" class="form-control" placeholder="type here..." value="{{ old('NtelR') }}">
								</div>
								<div>
									<label for="ItelE">Empresarial:</label>
									<input type="text" id="ItelE" name="NtelE" class="form-control bfh-phone" placeholder="type here..." value="{{ old('NtelE') }}">
								</div>
								<div>
									<label for="ItelC">Celular:</label>
									<input type="text" id="ItelC" name="NtelC" class="form-control" placeholder="type here..." value="{{ old('NtelC') }}">
								</div>
							</div>
						<fieldset>
						<legend>Dados do Plano de Saúde</legend>
						<div class="form-group">
							<label for="IplanoId">Plano:</label>
							<select id="IplanoId" name="NplanoId" class="form-control">
								{{ $i = 0 }}
								<option value=""></option>
									@foreach($planos as $plano)
										<option value="{{ $plano->id}}">{{ ++$i }} - {{ $plano->nome }}</option>
									@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="Imat">Matricula:</label>
							<input type="text" id="Imat" name="Nmat" class="form-control" value="{{ old('Nmat') }}">
						</div>
					</fieldset>
					

					<!-- ID do usuário que está fazendo o cadastro-->
					<div class="form-group" >
						<input type="number" id="IidAten" name="NidAten" value="1" hidden>
					</div>
				</fieldset>
				--}}
				<!--<button type="submit" class="btn btn-primary">Registrar</button>-->
				</form>			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="updateButtonModal">Update</button>
      </div>
    </div>
  </div>
</div>