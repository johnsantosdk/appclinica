<!-- Modal Edit-->
<div class="modal fade" id="editEspecialidadeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-edit-css">
        <h5 class="modal-title" id="editModalLabel">Editar Especialidade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('especialidade.update') }}" method="POST" class="form-horizontal" role="form" id="form-edit-especialidade">
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
              <input type="text" class="form-control" id="Inome" name="Nnome"  value="" >
            </div>
          </div>
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="Icbo">CBO:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="Icbo" name="Ncbo"  value="" >
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modalClose">Close</button>
        <button type="submit" class="btn btn-primary" id="updateButtonModal">Update</button>
      </div>
    </div>
  </div>
</div>