<!-- Modal Edit-->
<div class="modal fade" id="editPlanoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-edit-css">
        <h5 class="modal-title" id="editModalLabel">Editar Plano</h5>
        <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('plano.updatePlano') }}" method="POST" class="form-horizontal" role="form" id="form-edit-plano">
          {{ csrf_field() }}
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="Iid">ID:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="Iid" name="Nid" value="" readonly>
            </div>
          </div>
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="Inome">Nome:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="Inome" name="Nnome"  value="" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="Istatus">Status:</label>
              <select id="Istatus" name="Nstatus" class="form-control" placeholder="Status do Plano">
                <option value="{{ 1 }}" class="optionTrue">Ativo</option>
                <option value="{{ 0 }}" class="optionFalse">Suspenso</option>
              </select>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="updateButtonModal">Update</button>
      </div>
    </div>
  </div>
</div>