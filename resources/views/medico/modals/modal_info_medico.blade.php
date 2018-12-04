<!-- Modal Info-->
<div class="modal fade" id="infoMedicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-info-css">
        <h5 class="modal-title" id="infoMedicoLabel">Detalhes de Cadastro de Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <p id="infoModalNome"><strong>Nome</strong>: </p>
              <p id="infoModalCpf"><strong>CPF</strong>: </p>
              <p id="infoModalNasc"><strong>Data Nascimento</strong>: </p>
              <p id="infoModalCrm"><strong>CRM</strong>: </p>
      </div>
      <form action="">
        <div class="form-group">
          <label for="Icbo">CBO:</label>
          <select name="Ncbo" id="Icbo" class="form-control">
          </select> 
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="deleteButtonModal">Update</button>
      </div>
    </div>
  </div>
</div>
