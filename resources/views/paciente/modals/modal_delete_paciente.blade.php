<!-- Modal Delete-->
<div class="modal fade" id="deletePacienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-delete-css">
        <h5 class="modal-title" id="deletePacienteLabel">Deletar Cadastro de Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <p id="deleteModalNome"><strong>Nome</strong>: </p>
              <p id="deleteModalCpf"><strong>CPF</strong>: </p>
              <p id="deleteModalNasc"><strong>Data Nascimento</strong>: </p>
              <p id="deleteModalEmail"><strong>Email</strong>: </p>
              <p id="deleteModalContato"><strong>Contato</strong>: </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="deleteButtonModal">Update</button>
      </div>
    </div>
  </div>
</div>
