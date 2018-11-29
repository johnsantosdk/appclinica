<!-- Modal Delete-->
<div class="modal fade" id="deleteMedicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-delete-css">
        <h5 class="modal-title" id="deleteMedicoLabel">Deletar Cadastro de Médico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalReplace">
        <p id="deleteModalId"></p>
        <p id="deleteModalNome"></p>
        <p id="deleteModalNasc"></p>
        <p id="deleteModalCpf"></p>
        <p id="deleteModalEmail"></p>
      </div>
      <form action="{{ route('medico.destroy') }}" method="POST" id="form-delete-medico" hidden>
        <div class="form-group">
          <input type="number" id="Iid" name="Nid" value="">
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Fechar</button>
        <button type="submit" class="btn btn-danger" id="deleteButtonModalMedico">Deletar Cadastro</button>
      </div>
    </div>
  </div>
</div>
