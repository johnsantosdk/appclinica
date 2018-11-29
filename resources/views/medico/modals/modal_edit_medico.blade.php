<!-- Modal Edit-->
<div class="modal fade" id="editMedicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modal-content">
      <div class="modal-header modal-edit-css">
        <h5 class="modal-title" id="editMedicoLabel">Editar Cadastro de Médico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-success" id="medico-success" style="display:none;">
      	<p>A atualização dos dados foram realizados com <strong>SUCESSO</strong>!</p>
      </div>
      <div class="modal-body">
			{{-- Form de visulalização e edição --}}
			<form action="{{ route('medico.update') }}" class="form-horizontal" role="form" id="form-edit-medico">
				{{ csrf_field() }}
					<fieldset>
						<legend>Dados do Médico</legend>
						<div class="form-group" id="Nnome-error">
							<label for="Inome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control" value="" readonly="true">
						</div>

						<div class="form-group" id="Nnasc-error">
							<label for="Inasc">Nascimento:</label>
							<input type="date" id="Inasc" name="Nnasc" class="form-control" value="">
						</div>
						<div class="form-group" id="Nsexo-error" {{ $errors->has('Nsexo') ? 'has-error' : ''}}>
							<label for="Isexo">Sexo:</label>
							<select name="Nsexo" id="Isexo" class="form-control">
								<option value=""></option>
								<option value="masculino">Masculino</option>
								<option value="femenino">Femenino</option>
							</select>
						</div>
						<div class="form-group" id="Ncpf-error">
							<label for="Icpf">CPF:</label>
							<input type="text" id="Icpf" name="Ncpf" class="form-control" value="" readonly="true">
						</div>

						<div class="form-group" id="Nemail-error">
							<label for="Iemail">CRM</label>
							<input type="number" id="Icrm" name="Ncrm" class="form-control" value="" >
						</div>
						<hr>  
						<legend>Área de atuação</legend>
						<div class="form-group" id="Nmedicoid-error">
							<label for="Imedicoid">Especialidade:</label>
							<select id="Imedicoid" name="Nmedicoid" class="form-control">
								{{ $i = 0 }}
								<option value=""></option>
								@if(isset($especialidades))
									@foreach($especialidades as $especialidade)
										<option value="{{ $especialidade->idespecialidade}}">{{ $especialidade->cbo }} - {{ $especialidade->nome }}</option>
									@endforeach
								@endif
							</select>
						</div>
					</fieldset>
					<!-- ID do usuário que está fazendo o cadastro-->
					<div class="form-group" >
						<input type="number" id="Iidmedico" name="Nidmedico" value="" hidden>
						<input type="number" id="Iidatendente" name="Nidatendente" value="1" hidden>
					</div>
				</fieldset>
			</form>			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="buttonSubmitFormMedico">Update</button>
        {{--<input type="submit" class="btn btn-primary" value="Salvar">--}}
      </div>
    </div>
  </div>
</div>
