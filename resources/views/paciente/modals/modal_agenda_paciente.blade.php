<!-- Modal Edit-->
<div class="modal fade" id="agendaPacienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modal-content">
      <div class="modal-header modal-edit-css">
        <h5 class="modal-title" id="agendaPacienteLabel">Agendamento de Consulta</h5>
        <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-success" id="paciente-success" style="display:none;">
      	<p>A atualização dos dados foram realizados com <strong>SUCESSO</strong>!</p>
      </div>
      <div class="modal-body">
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary" id="buttonSubmitFormAgendaPaciente">Agendar</button>
        {{--<input type="submit" class="btn btn-primary" value="Salvar">--}}
      </div>
    </div>
  </div>
</div>
