@extends('layouts.app')

@section('title', 'Lista de Médicos')

@section('content')
<div class="container">
	<div class='row'>
		<div class="col-sm-10">
			<div id="alertDeletetPaciente">
				
			</div>
			<form action="{{ route('medico.list') }}" method="post" class="bg-and-color-text-form">
				{{ csrf_field() }}
				<div class="row">
					{{-- <div class="col-sm-6">
						<div class="form-group">
							<label for="Iesp">Especialidade</label>
							<select class="form-control" name="Nesp" id="Iesp">
								<option value=""></option>
								@if(isset($especialidades))
									@foreach($especialidades as $especialidade)
										<option value="{{ $especialidade->idespecialidade }}">{{ $especialidade->cbo }} - {{ $especialidade->nome }}</option>
									@endforeach
								@endif
							</select>
						</div>
					</div> --}}
					<div class="col">
						<div class="form-group">
							<label for="Inome">Nome:</label>
							<input type="text" id="Inome" name="Nnome" class="form-control" value="{{ old('Nnome') }}">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="Icrm">CRM:</label>
							<input type="number" id="Icrm" name="Ncrm" class="form-control" placeholder="">
						</div>
					</div>
				</div>
				<div class="">
					<div class="form-group">
						<button type="submit" class="btn btn-primary float-right" id="searchSubmit"> Pesquisar</button>
					</div>
				</div><br><br>
			</form>
			@if(isset($medicos) && count($medicos) == 0)
				<div class="alert alert-info" id="testFade">
	  				<strong>Sem resultas!</strong> Nenhum resultado encontrado para os dados informados acima.
				</div>
			@endif
			@if(isset($medicos) && (count($medicos) > 0))
				<div class="table-responsive">
	  				<table class="table" id="tableListMedicos">
	  					<div><p><strong>Total</strong>: {{ count($medicos) }} cadastrado(s)</p></div> 
						<thead class="">
							<tr>
								<th scope="col">ID</th>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">CRM</th>
								{{-- <th scope="col" class="text-center">CBO</th> --}}
								<th scope="col" class="text-center">Ação</th>
							</tr>
						</thead>
						<tbody id="medicos-list">
							@foreach ($medicos as $medico)
								<tr id="medico{{ $medico->idmedico }}">{{-- id de cada registro --}}
									<th scope="row">{{ $medico->idmedico }}</th>
									<td class="text-center">{{ $medico->nome }}</td>
									<td class="text-center">{{ $medico->crm }}</td>
									{{-- <td class="text-center">{{ $medico->especialidade == null ? 'Não cadastrado': $medico->especialidade}}</td> --}}
									<td class="text-center">

										<button type="button" 
												class="btn btn-info"
												data-toggle="modal"
			                                    data-target="#infoMedicoModal"
			                                    data-id="{{$medico->idmedico}}"
			                                    {{-- data-idesp="{{ $medico->idesp}}" --}}
			                                    data-nome="{{$medico->nome}}"
												data-cpf="{{$medico->crm}}"
			                                    id="tableInfoButton">
										Detalhes
										</button>

										<button type="button" 
												class="btn btn-primary"
												data-toggle="modal"
			                                    data-target="#editMedicoModal"
			                                    data-id="{{$medico->idmedico}}"
			                                    {{-- data-idesp="{{ $medico->idesp}}" --}}
			                                    data-nome="{{$medico->nome}}"
												data-cpf="{{$medico->crm}}"
			                                    id="tableEditButton">
										Editar 
										</button>
										
										<button type="button" 
												class="btn btn-danger"
												data-toggle="modal"
			                                    data-target="#deleteMedicoModal"
			                                    data-id="{{$medico->idmedico}}"
			                                    data-nome="{{$medico->nome}}"
												data-status="{{$medico->crm}}"
			                                    id="tableDeleteButton">
										Deletar
										</button>
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfooter>
							<tr>
								<th scope="col" class="">ID</th>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">CRM</th>
								{{-- <th scope="col" class="text-center">CBO</th> --}}
								<th scope="col" class="text-center">Ação</th>
							</tr>
						</tfooter>
	  				</table>
				</div>
			@endif
		</div>
	</div>
	{{--  
	@if(isset($medicos) && count($medicos) > 1)
		<div class="text-center">
	        {{   $medicos->links() }}
	    </div>
	@endif
	--}}
</div>
{{-- includes de modals --}}
{{-- Modal edit --}}
@include('medico.modals.modal_edit_medico')
{{-- Modal delete--}}
@include('medico.modals.modal_delete_medico') 
{{-- Modal info--}}
@include('medico.modals.modal_info_medico')
@endsection

@section('customer-javaScript')

{{-- <script> <script>--}}{{-- RETIRE O COMENTÁRIO DA TAG <SCRIPT> PARA VISUALIZAR O CÓDIGO COLORIDO --}} 

	//>>>BEGIN <<REQUEST FROM DATABASE>>
	//<<<END REQUEST FROM DATABASE
	//>>>BEGIN <<EDIT MODAL>>
        $(document).on('click','#tableEditButton', function(){
            var id = $(this).data('id');
            var id2 = $(this).data('idesp'); 
			$('#medico-success').hide(1000);
			//console.log($(this).data('id'));
            $.post('{{ route('medico.show') }}', {id:id, id2:id2}, function(data){
                console.log(data);
                //MASKARAS
				$('#editMedicoModal').find('#Icpf').mask('000.000.000-00');
               
                //LIMPA O FORMULÁRIO ANTES DE INSERIR AS INFORMAÇÕES
                $(':input','#form-edit-medico')
  				.not(':button, :submit, :reset, :hidden')
  				.val('')
  				.removeAttr('selected');
  				//INSERÇÃO DOS DADOS NOs DEVIDOS CAMPOS/INPUTS
                $('#editMedicoModal').find('#Iidmedico').val(data.idmedico);
                $('#editMedicoModal').find('#Inome').val(data.nome);
                $('#editMedicoModal').find('#Inasc').val(data.nascimento);
                //
                if(data.sexo == 'femenino' || data.sexo == 'FEMENINO'){
                	$('#editMedicoModal').find('#Isexo').val("femenino");
                }if(data.sexo == 'masculino' || data.sexo == 'MASCULINO'){
					$('#editMedicoModal').find('#Isexo').val("masculino");
            	}
            	//
                $('#editMedicoModal').find('#Icpf').val(data.cpf).mask('000.000.000-00');
				$('#editMedicoModal').find('#Icrm').val(data.crm);
				//
				$('#editMedicoModal').find('#Iespid').prop('selectIndex',0); 
                $('#editMedicoModal').find('#Iespid').val(data.idesp);   
                $('#editMedicoModal').find('#IoldIdesp').val(data.idesp);   
                $('#form-edit-medico').show();
                $('.modal-title').text('Editar Cadastro de Médico');
            });
        });
    //<<<END <<EDIT MODAL>>
    //>>>BEGIN <<UPDATE MODAL>>
        $('#buttonSubmitFormMedico').click(function(){
            var formData = $('#form-edit-medico').serialize();
            $.ajax({
                type : 'POST',
                url  : '{{ route('medico.update') }}',
                datatype: 'json',
                data: formData,
                success: function(data)
                { 
                    console.log(data);
             		$('#editMedicoModal').show().scrollTop(0);
                    $('#medico-success').show("slow");
                    //
                    var tr = $('<tr/>');
                    tr.append($("<td/>",{
                        text : data.idmedico
                    })).append($("<td/>",{
                        text : data.nome
                    })).append($("<td/>",{
                        text : data.crm
                    })).append($("<td/>",{
                        html: "<button type='button' class='btn btn-info text-center' data-toggle='modal' data-target='#infoMedicoModal' data-id='"+data.id+"' data-nome='"+data.nome+"' data-status='"+data.crm+"'>Detalhes</button>" + "<button type='button' class='btn btn-info text-center' data-toggle='modal' data-target='#editMedicoModal' data-id='"+data.id+"' data-nome='"+data.nome+"' data-status='"+data.crm+"' id='tableEditModal'>Editar</button>" + " <button type='button' class='btn btn-danger text-center' data-toggle='modal' data-target='#deleteMedicoModal' data-id='"+data.id+"' data-nome='"+data.nome+"' data-status='"+data.crm+"'>Deletar</button>"
                    }))
                    $('tr#medico'+data.idmedico).replaceWith(tr);
                    //console.log('tr#medico'+data.idmedico);
                    
                },
                error: function(xhr)
                {
					//console.log(xhr);
                     //1 - Procurar o campo que tem erro de validação
                     //2 - Inseri o texto de error logo abaixo do campo
                     $.each(xhr.responseJSON.errors, function(key,value) {
                        $('#'+key+'-error').append('<p class="help-block alert alert-danger">'+value+'</p>');
                    });

            	}
            });
            $('p.help-block').remove();
        });
    //<<<END <<UPDATE MODAL>>
    //>>>BEGIN <<SHOW MODAL DELETE>>
        $(document).on('click', '#tableDeleteButton', function(){
            var id = $(this).data('id');
            $('#deleteMedicoModal').find('#modalReplace').replaceWith('<div class="modal-body" id="modalReplace"><p id="deleteModalId"></p><p id="deleteModalNome"></p><p id="deleteModalNasc"></p><p id="deleteModalCpf"></p><p id="deleteModalCrm"></p></div>');
			console.log('id = '+id+' antes de exluir');
            $.post('{{ route('medico.showDestroy') }}', {id:id}, function(data){
                $('#deleteMedicoModal').find('input#Iid').val(data.idmedico);
                $('#deleteMedicoModal').find('p#deleteModalId').html('<strong style="font-size:18px">ID:</strong> '+data.idmedico);
                $('#deleteMedicoModal').find('p#deleteModalNome').html('<strong style="font-size:18px">Nome:</strong> '+data.nome);
                $('#deleteMedicoModal').find('p#deleteModalNasc').html('<strong style="font-size:18px">Data Nascimento:</strong> '+data.nascimento);
                $('#deleteMedicoModal').find('p#deleteModalCpf').html('<strong style="font-size:18px">CPF:</strong> '+data.cpf);
				$('#deleteMeidcoModal').find('p#deleteModalCrm').html('<strong style="font-size:18px">CRM:</strong> '+data.crm);
                
                //------------------------------------------------------------------
                $('.modal-body').show();
                $('.modal-title').text('Deletar Cadasto');
                   console.log(data);
                });
        });
    //<<<END <<SHOW MODAL DELETE>>
    //>>>BEGIN <<DELETE MODAL>>
        $("#deleteButtonModalMedico").click(function(){
            $.ajax({
                type : 'POST',
                url  : '{{ route('medico.destroy') }}',
                datatype: 'json',
                data : $("#form-delete-medico").serialize(),
                success: function(data)
                {
                	console.log('Dados vindo do controller'+ data);
                	$('#deleteMedicoModal').find('#modalReplace').replaceWith('<div class="modal-body" id="modalReplace"><p class="help-block alert alert-success text-center">Registro deletado com <strong>SUCESSO!</strong></p></div>');
                    $('tr#medico'+data).remove();
                    //$('#closeModal').trigger('click');
                },
                errors: function(xhr)
                {
                    console.log("FAIL");
                    $('#deleteMedicoModal').find('#modalReplace').replaceWith('<p class="help-block alert alert-info text-center"><strong>OPS!</strong> Algo de errado aconteceu. O registro não foi deletado. Contate o <strong>SUPPORT</strong></p>');
                }
            })
            //location.reload();
        });
    //<<<END <<DELETE PLANO NODEL>>

	//<<<SHOW MODAL INFO>>
		$(document).on('click', '#tableInfoButton', function(event){
			event.preventDefault();
            var id = $(this).data('id');
            //Remove os li(s) que eventualmente foram adicionados anteriormente
            $("#infoMedicoModal").find('.list-group-item').remove();
            $.post('{{ route('medico.info') }}', {id:id}, function(data){
                $('#infoMedicoModal').find('p#infoModalId').html('<strong>ID</strong>: '+data.idmedico);
                $('#infoMedicoModal').find('p#infoModalNome').html('<strong>Nome</strong>: '+data.nome);
                $('#infoMedicoModal').find('p#infoModalSexo').html('<strong>Sexo</strong>: '+data.sexo);
                $('#infoMedicoModal').find('p#infoModalNasc').html('<strong>Nasc.</strong>: '+data.nascimento);
                $('#infoMedicoModal').find('p#infoModalCpf').html('<strong>CPF</strong>: '+data.cpf);
				$('#infoMedicoModal').find('p#infoModalCrm').html('<strong>CRM</strong>: '+data.crm);
                let esps = data.especialidades;
                $.each(esps, function (i, item) {
					$("#infoMedicoModal").find("#infoModalListEsp").append("<li class='list-group-item'>"+item.cbo+" - "+item.nome+"</li>");
            	});
                //------------------------------------------------------------------
                //$('.modal-body').show();
                if(data.sexo == 'masculino' || data.sexo == 'Masculino'){
					$('.modal-title').text('Detalhes do Cadastro do Médico');
            	}else{
					$('.modal-title').text('Detalhes da Cadastro da Médica');
            	}
                
                });

        });


	//>><<END MODAL INFO

    //<<<BEGIN TEST MODAL>>
    	{{-- $(document).on('click','#tableInfoButton', function(e){
    		e.preventDefault();
			var id = $(this).data('id');
			$.post('{{ route('medico.info') }}', {id:id}, function(data){
				console.log(data[0]);
				$.each(data, function (i, item) {
					$("#infoMedicoModal").find("#Icbo").append($('<option>', {
						value: item.idespecialidade,
						text: item.cbo+" - "+item.nome
					}));
				});

			});
    	}); --}}
    //>><<END MODAL>>
{{-- </script> --}}{{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection
