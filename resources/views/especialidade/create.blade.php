@extends('layouts.app')

@section('title', 'Cadastro')

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
			<form action="{{ route('especialidade.store') }}" method="post">
				{{ csrf_field() }}
					<fieldset>
						<legend>Especialidade</legend>
						<div class="form-group" {{ $errors->has('Nnome') ? 'has-error' : ''}}>
							<label for="Inome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control" value="{{ old('Nnome') }}">
							{!! $errors->first('Nnome', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
						<div class="form-group" {{ $errors->has('Ncbo') ? 'has-error' : ''}}>
							<label for="Icbo">CBO:</label>
							<input type="number" id="Icbo" name="Ncbo" class="form-control" value="{{ old('Ncbo') }}">
							{!! $errors->first('Ncbo', '<p class="help-block alert alert-danger">:message</p>') !!}
						</div>
					<!-- ID do usuário que está fazendo o cadastro-->
					<div class="form-group" >
						<input type="number" id="IidAten" name="NidAten" value="1" hidden>
					</div>
				</fieldset>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</form>
		@if(isset($especialidades))
			<hr>{{--  <p>CBO(s) cadastrados: <strong>{{ count($especialidades) }}</strong> </p>--}}
			<div class="table-responsive">
  				<table class="table" id="tableCreateEspecialidade">
					<thead class="">
						<tr>
							<th scope="col">ID</th>
							<th class="text-center" scope="col">CBO</th>
							<th class="text-center" scope="col">Descrição</th>
						</tr>
					</thead>
					<tbody id="especialidades-list">
						@foreach ($especialidades as $especialidade)
							<tr id="especialidade{{ $especialidade->idespecialidade }}">
								<th scope="row">{{ $especialidade->idespecialidade}}</th>
								<td>{{ $especialidade->cbo }}</td>
								<td>{{ $especialidade->nome }}</td>
								<td>
									<button type="button" 
											class="btn btn-info"
											data-toggle="modal"
		                                    data-target="#editEspecialidadeModal"
		                                    data-id="{{$especialidade->idespecialidade}}"
		                                    data-nome="{{$especialidade->cbo}}"
											data-cbo="{{$especialidade->nome}}"
		                                    id="tableEditButton">
									Editar
									</button>
									
									<button type="button" 
											class="btn btn-danger"
											data-toggle="modal"
		                                    data-target="#deleteEspecialidadeModal"
		                                    data-id="{{$especialidade->idespecialidade}}"
		                                    data-nome="{{$especialidade->nome}}"
											data-cbo="{{$especialidade->cbo}}"
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
							<th class="text-center" scope="col">CBO</th>
                            <th class="text-center" scope="col">Descrição</th>
                            <th class="text-center" scope="col">Ação</th>
						</tr>
					</tfooter>
  				</table>
			</div>
		@endif
		</div>
		</div>
			<div class="text-center">
	            <p>{{   $especialidades->links() }}</p>
	        </div>
		</div>
		</div>
	</div>
</div>
{{-- includes de modals --}}
{{-- Modal delete --}}
@include('especialidade.modals.modal_delete_especialidade')
{{-- Modal edit --}}
@include('especialidade.modals.modal_edit_especialidade')
@endsection

@section('customer-javaScript')
{{-- <script> --}}{{-- RETIRE O COMENTÁRIO DA TAG <SCRIPT> PARA VISUALIZAR O CÓDIGO COLORIDO --}}
    //>>>BEGIN <<SHOW EDIT MODAL>>
        $(document).on('click','#tableEditButton', function(){
            var id = $(this).data('id');
	
            $.post('{{ route('especialidade.show') }}', {id:id}, function(data){
            console.log(data);
                $('#editEspecialidadeModal').find('#Iid').val(data.idespecialidade);
                $('#editEspecialidadeModal').find('#Inome').val(data.nome);
                $('#editEspecialidadeModal').find('#Icbo').val(data.cbo);
                    
                $('#form-edit-especialidade').show();
                $('.modal-title').text('Editar');
                console.log(data);
            });
        });
    //<<<END <<SHOW EDIT MODAL>>

    //>>>BEGIN <<UPDATE MODAL>>
        $("#updateButtonModal").click(function(){
            $.ajax({
                type : 'get',
                url  : '{{ route('especialidade.update') }}',
                datatype: 'json',
                data: $("#form-edit-especialidade").serialize(),
                success: function(data)
                {
                    var tr = $('<tr/>');
                    tr.append($("<td/>",{
                        text : data.idespecialidade
                    })).append($("<td/>",{
                        text : data.cbo
                    })).append($("<td/>",{
                        text : data.nome
                    })).append($("<td/>",{
                        html: "<button type='button' class='btn btn-info text-center' data-toggle='modal' data-target='#editEspecialidadeModal' data-id='"+data.id+"' data-nome='"+data.nome+"' data-cbo='"+data.cbo+"' id='tableEditModal'>Editar</button>" + " <button type='button' class='btn btn-danger text-center' data-toggle='modal' data-target='#deleteEspecialidadeModal' data-id='"+data.id+"' data-nome='"+data.nome+"' data-cbo='"+data.cbo+"'>Deletar</button>"
                    }))
                    $('tr#especialidade'+data.idespecialidade).replaceWith(tr);
                    $('#modalClose').trigger('click');
                    console.log('tr#especialidade'+data.idespecialidade);
                },
                error: function(xhr){
                    console.log(xhr);
                }

                });
            });
    //<<<END <<UPDATE MODAL>>

    //>>>BEGIN <<SHOW MODAL DELETE>>
        $(document).on('click', '#tableDeleteButton', function(){
            var id = $(this).data('id');
            var nome = $(this).data('nome');
            var status = $(this).data('cbo');
           $('#deleteEspecialidadeModal').find('#modalReplace').replaceWith('<div class="modal-body" id="modalReplace"><p style="font-size:18px" id="id"></p><p style="font-size:18px" id="nome"></p><p style="font-size:18px" id="cbo"></p></div>');
            $.post('{{ route('especialidade.showDestroy') }}', {id:id}, function(data){
                $('#deleteEspecialidadeModal').find('#Iid').val(data.idespecialidade);
                $('#deleteEspecialidadeModal').find('p#id').html('<strong style="font-size:18px">ID:</strong> '+data.idespecialidade);
                $('#deleteEspecialidadeModal').find('p#nome').html('<strong style="font-size:18px">Name:</strong> '+data.nome);
                $('#deleteEspecialidadeModal').find('p#cbo').html('<strong style="font-size:18px">CBO:</strong> '+data.cbo);
                //------------------------------------------------------------------
                $('.modal-body').show();
                $('.modal-title').text('Deletar');
                });
        });
    //<<<END <<SHOW MODAL DELETE>>

    //>>>BEGIN <<DELETE MODEL>>
        $("#deleteButtonModal").click(function(){
            
            $.ajax({
                type : 'POST',
                url  : '{{ route('especialidade.destroy') }}',
                datatype: 'json',
                data : $("#form-delete-especialidade").serialize(),
                success: function(data)
                {
                    console.log(data);
                    $('#deleteEspecialidadeModal').find('#modalReplace').replaceWith('<div class="modal-body" id="modalReplace"><p class="help-block alert alert-success text-center">Registro deletado com <strong>SUCESSO!</strong></p></div>');
                    $('tr#especialidade'+data).remove();
                    $('#deleteEspecialidadeModal').closest();
                },
                errors: function(data)
                {
                    console.log("falhou");
                    $('#deleteEspecialidadeModal').find('#modalReplace').replaceWith('<p class="help-block alert alert-info text-center"><strong>OPS!</strong> Algo de errado aconteceu. O registro não foi deletado. Contate o <strong>SUPPORT</strong></p>');
                }
            })
            //location.reload();
        });
    //<<<END <<DELETE MODEL>>
{{-- </script> --}}{{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection