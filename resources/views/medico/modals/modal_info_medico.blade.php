<!-- Modal Info-->
<div class="modal fade" id="infoMedicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-info-css">
        <h5 class="modal-title" id="infoMedicoLabel">Detalhes do Cadastro de Paciente</h5>
        <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="infoModalNome"></p>
        <p id="infoModalSexo"></p>
        <p id="infoModalNasc"></p>
        <p id="infoModalCpf"></p>
        <p id="infoModalCrm"></p>
        <h3>Lista das áreas em atuação</h3>
        <ul class="list-group" id="infoModalListEsp">  
        </ul>
      </div>
      {{-- <form action="">
        <div class="form-group" style="padding:15px">
          <label for="Icbo">CBO:</label>
          <select name="Ncbo" id="Icbo" class="form-control">
          </select> 
        </div>
      </form> --}}
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        {{-- <button type="submit" class="btn btn-primary" id="deleteButtonModal">Update</button> --}}
      </div>
    </div>
  </div>
</div>
