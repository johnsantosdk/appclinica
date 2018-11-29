<!-- Modal Delete-->
<div class="modal fade" id="deleteEspecialidadeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Deletar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="form-delete-especialidade">
          <div class="form-group row add" hidden>
            <label class="control-label col-sm-2" for="id">ID:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="Iid" name="Nid" value="">
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>
        </form>
        <div class="modal-body" id="modalReplace">
          <p style="font-size:18px" id="id"></p>
          <p style="font-size:18px" id="nome"></p>
          <p style="font-size:18px" id="cbo"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger" id="deleteButtonModal">Deletar</button>
      </div>
    </div>
  </div>
</div>