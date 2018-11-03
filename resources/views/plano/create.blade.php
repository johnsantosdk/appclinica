@extends('layouts.app')

@section('title', 'Registro de Planos')

@section('head')

@endsection

@section('content')

<div class="container">

	<div class='row'>
		<div class="col-sm-10">
			<form action="{{ action('PlanoController@store') }}" method="GET" class="form-createPlano">
				{{ csrf_field() }}
				<fieldset>
					<legend>Plano</legend>
					<div class="form-group">
						<label for="Inome">Nome:</label>
						<input type="text" id="Inome" name="Nnome" class="form-control" style="text-transform:uppercase" autofocus>
					</div>
					<div class="form-group">
						<label for="Istatus">Status:</label>
						<select id="Istatus" name="Nstatus" class="form-control" placeholder="Status do Plano">
							<option value=""></option>
							<option value="{{ 1 }}" class="optionTrue">Ativo</option>
							<option value="{{ 0 }}" class="optionFalse">Suspenso</option>
						</select>
					</div>
				</fieldset>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		
			<div class="table-responsive">
  				<table class="table" id="tableCreatePlano">
					<thead class="">
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Plano</th>
							<th scope="col">Status</th>
							<th scope="col">Ação</th>
						</tr>
					</thead>
					<tbody id="planos-list">
						@foreach ($planos as $plano)
							<tr id="plano{{ $plano->id }}">
								<th scope="row">{{ $plano->id}}</th>
								<td>{{ $plano->nome }}</td>
								@if ($plano->status_plano == 1)
								 	<td class="statusTrue">ATIVO</td>
								@else
									<td class="statusFalse">SUSPENSO</td>
								@endif
								<td>
									<button type="button" 
											class="btn btn-info"
											data-toggle="modal"
		                                    data-target="#editPlanoModal"
		                                    data-id="{{$plano->id}}"
		                                    data-nome="{{$plano->nome}}"
											data-status="{{$plano->status_plano}}"
		                                    id="tableEditButton">
									Editar
									</button>
									
									<button type="button" 
											class="btn btn-danger"
											data-toggle="modal"
		                                    data-target="#deletePlanoModal"
		                                    data-id="{{$plano->id}}"
		                                    data-nome="{{$plano->nome}}"
											data-status="{{$plano->status_plano}}"
		                                    id="tableDeleteButton">
									Deletar
									</button>
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfooter>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Plano</th>
						</tr>
					</tfooter>
  				</table>
			</div>
		</div>
	</div>
		<div class="centralizado">
            <p>{{   $planos->links() }}</p>
        </div>
</div>
{{-- includes de modals --}}
{{-- Modal edit --}}
@include('plano.modals.modal_edit_plano')
{{-- Modal delete --}}
@include('plano.modals.modal_delete_plano')
@endsection

@section('customer-javaScript')
{{-- <script> --}}{{-- RETIRE O COMENTÁRIO DA TAG <SCRIPT> PARA VISUALIZAR O CÓDIGO COLORIDO --}}
    //>>>BEGIN <<EDIT MODAL>>
        $(document).on('click','#tableEditButton', function(){
            var id = $(this).data('id');

            $.post('{{ action('PlanoController@editPlano') }}', {id:id}, function(data){
                $('#editPlanoModal').find('#Iid').val(data.id);
                $('#editPlanoModal').find('#Inome').val(data.nome);
                $('#editPlanoModal').find('#Istatus').val(data.status);
                    
                $('#form-edit-plano').show();
                $('.modal-title').text('Editar Plano');
            });
        });
    //<<<END <<EDIT MODAL>>

    //>>>BEGIN <<UPDATE MODAL>>
        $("#updateButtonModal").click(function(){
            $.ajax({
                type : 'get',
                url  : '{{ action('PlanoController@updatePlano') }}',
                datatype: 'json',
                data: $("#form-edit-plano").serialize(),
                success: function(data)
                { console.log(data);
                    var tr = $('<tr/>');
                    tr.append($("<td/>",{
                        text : data.id
                    })).append($("<td/>",{
                        text : data.nome
                    })).append($("<td/>",{
                        text : data.status
                    })).append($("<td/>",{
                        html: "<button type='button' class='btn btn-info' data-toggle='modal' data-target='#editPlanoModal' data-id='"+data.id+"' data-nome='"+data.nome+"' data-status='"+data.status+"' id='tableEditModal'>Editar</button>" + "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deletePlanoModal' data-id='"+data.id+"' data-nome='"+data.nome+"' data-status='"+data.status+"'>Deletar</button>"
                    }))
                    $('#planos-list tr#plano'+data.id).replaceWith(tr);
                    }

                })
                    location.reload();
            });
    //<<<END <<UPDATE MODAL>>

    //>>>BEGIN <<SHOW MODAL DELETE>>
        $(document).on('click', '#planos-list #tableDeleteButton', function(){
            var id = $(this).data('id');
            var nome = $(this).data('nome');
            var status = $(this).data('status');
            $.post('{{ action('PlanoController@showPlano') }}', {id:id}, function(data){
                $('#deletePlanoModal').find('input#Iid').val(data.id)
                $('#deletePlanoModal').find('p#id').html('<strong style="font-size:18px">ID:</strong> '+data.id);
                $('#deletePlanoModal').find('p#nome').html('<strong style="font-size:18px">Name:</strong> '+data.nome);
                if(data.status_plano == 1){
                    var status = ["ATIVO", "SUSPENSO"];
                    $('#deletePlanoModal').find('p#status').html('<strong style="font-size:18px">Status:</strong> '+status[0]);
                }else
                    $('#deletePlanoModal').find('p#status').html('<strong style="font-size:18px">Status:</strong> '+status[1]);
                //------------------------------------------------------------------
                $('.modal-body').show();
                $('.modal-title').text('Deletar Plano');
                });
        });
    //<<<END <<SHOW MODAL DELETE>>

    //>>>BEGIN <<DELETE PLANO NODEL>>
        $("#deleteButtonModal").click(function(){
            $.ajax({
                type : 'POST',
                url  : '{{ action('PlanoController@destroyPlano') }}',
                datatype: 'json',
                data : $("#form-delete-plano").serialize(),
                success: function(data)
                {
                    console.log(data);
                    $('#planos-list tr#plano'+data.id).remove();
                    $('#deletePlanoModal').closest();
                }
            })
            location.reload();
        });
    //<<<END <<DELETE PLANO NODEL>>
{{-- </script> --}}{{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection