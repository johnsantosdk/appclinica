@extends('layouts.app')

@section('title', 'Cadastro de Convênios')

@section('head')

@endsection

@section('content')

<div class="container">

	<div class='row'>
            @if (Session::has('flash_message'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div align="center" class="alert {{Session::get('flash_message')['class']}}">
                                {{ Session::get('flash_message')['msg'] }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
		<div class="col-sm-10">
			<form action="{{ action('PlanoController@store') }}" method="GET" class="form-createPlano bg-and-color-text-form">
				{{ csrf_field() }}
				<fieldset>
					<legend>Dados do Convênio</legend>
					<div class="form-group" {{ $errors->has('Nnome') ? 'has-error' : ''}}>
						<label for="Inome">Nome:</label>
						<input type="text" id="Inome" name="Nnome" class="form-control" style="text-transform:uppercase" value="{{ old('Nnome') }}" autofocus>
					    {!! $errors->first('Nnome', '<p class="help-block alert alert-danger">:message</p>') !!}
                    </div>
					<div class="form-group" {{ $errors->has('Nstatus') ? 'has-error' : ''}}>
						<label for="Istatus">Status:</label>
						<select id="Istatus" name="Nstatus" class="form-control" placeholder="Status do Plano">
							<option value=""></option>
							<option value="{{ 1 }}" class="optionTrue">Ativo</option>
							<option value="{{ 0 }}" class="optionFalse">Suspenso</option>
						</select>
                        {!! $errors->first('Nstatus', '<p class="help-block alert alert-danger">:message</p>') !!}
					</div>
				</fieldset>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		
			<div class="table-responsive">
  				<table class="table" id="tableCreatePlano">
					<thead class="">
						<tr>
							<th scope="col">ID</th>
							<th class="text-center" scope="col">Nome do Convênio</th>
							<th class="text-center" scope="col">Status</th>
							<th class="text-center" scope="col">Ação</th>
						</tr>
					</thead>
					<tbody id="planos-list">
						@foreach ($planos as $plano)
							<tr id="plano{{ $plano->idplano }}">
								<th scope="row">{{ $plano->idplano}}</th>
								<td>{{ $plano->nome }}</td>
								@if ($plano->status == 1)
								 	<td class="statusTrue">ATIVO</td>
								@else
									<td class="statusFalse">SUSPENSO</td>
								@endif
								<td>
									<button type="button" 
											class="btn btn-info"
											data-toggle="modal"
		                                    data-target="#editPlanoModal"
		                                    data-id="{{$plano->idplano}}"
		                                    data-nome="{{$plano->nome}}"
											data-status="{{$plano->status}}"
		                                    id="tableEditButton">
									Editar
									</button>
									
									<button type="button" 
											class="btn btn-danger"
											data-toggle="modal"
		                                    data-target="#deletePlanoModal"
		                                    data-id="{{$plano->idplano}}"
		                                    data-nome="{{$plano->nome}}"
											data-status="{{$plano->status}}"
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
							<th class="text-center" scope="col">Nome do Convênio</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Ação</th>
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
    //>>>BEGIN <<SHOW EDIT MODAL>>
        $(document).on('click','#tableEditButton', function(){
            var id = $(this).data('id');

            $.post('{{ action('PlanoController@editPlano') }}', {id:id}, function(data){
                $('#editPlanoModal').find('#Iid').val(data.idplano);
                $('#editPlanoModal').find('#Inome').val(data.nome);
                $('#editPlanoModal').find('#Istatus').val(data.status);
                    
                $('#form-edit-plano').show();
                $('.modal-title').text('Editar Plano');
                console.log(data);
            });
        });
    //<<<END <<SHOW EDIT MODAL>>

    //>>>BEGIN <<UPDATE MODAL>>
        $("#updateButtonModal").click(function(){
            $.ajax({
                type : 'get',
                url  : '{{ action('PlanoController@updatePlano') }}',
                datatype: 'json',
                data: $("#form-edit-plano").serialize(),
                success: function(data)
                {
                    if(data.status = 1){
                        var status = 'ATIVO';
                    }else{
                        status = 'SUSPENSO';
                    }
                    var tr = $('<tr/>');
                    tr.append($("<td/>",{
                        text : data.idplano
                    })).append($("<td/>",{
                        text : data.nome
                    })).append($("<td/>",{
                        text : status
                    })).append($("<td/>",{
                        html: "<button type='button' class='btn btn-info text-center' data-toggle='modal' data-target='#editPlanoModal' data-id='"+data.id+"' data-nome='"+data.nome+"' data-status='"+data.status+"' id='tableEditModal'>Editar</button>" + " <button type='button' class='btn btn-danger text-center' data-toggle='modal' data-target='#deletePlanoModal' data-id='"+data.id+"' data-nome='"+data.nome+"' data-status='"+data.status+"'>Deletar</button>"
                    }))
                    $('tr#plano'+data.idplano).replaceWith(tr);
                    //console.log('tr#plano'+data.idplano);
                },
                error: function(xhr){
                    console.log(xhr);
                }

                });
                    //console.log(data);
                    //location.reload();
            });
    //<<<END <<UPDATE MODAL>>

    //>>>BEGIN <<SHOW MODAL DELETE>>
        $(document).on('click', '#planos-list #tableDeleteButton', function(){
            var id = $(this).data('id');
            var nome = $(this).data('nome');
            var status = $(this).data('status');
            $('#deletePlanoModal').find('#modalReplace').replaceWith('<div class="modal-body" id="modalReplace"><p style="font-size:18px" id="id"></p><p style="font-size:18px" id="nome"></p><p style="font-size:18px" id="status"></p></div>');
            $.post('{{ action('PlanoController@showPlano') }}', {id:id}, function(data){
                $('#deletePlanoModal').find('#Iid').val(data.idplano);
                $('#deletePlanoModal').find('p#id').html('<strong style="font-size:18px">ID:</strong> '+data.idplano);
                $('#deletePlanoModal').find('p#nome').html('<strong style="font-size:18px">Name:</strong> '+data.nome);
                var status = ["ATIVO", "SUSPENSO"];
                if(data.status == 1){
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
                    $('#deletePlanoModal').find('#modalReplace').replaceWith('<div class="modal-body" id="modalReplace"><p class="help-block alert alert-success text-center">Registro deletado com <strong>SUCESSO!</strong></p></div>');
                    $('tr#plano'+data).remove();
                    $('#deletePlanoModal').closest();
                },
                errors: function(data)
                {
                    console.log("falhou");
                    $('#deletePacienteModal').find('#modalReplace').replaceWith('<p class="help-block alert alert-info text-center"><strong>OPS!</strong> Algo de errado aconteceu. O registro não foi deletado. Contate o <strong>SUPPORT</strong></p>');
                }
            })
            //location.reload();
        });
    //<<<END <<DELETE PLANO NODEL>>
{{-- </script> --}}{{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection