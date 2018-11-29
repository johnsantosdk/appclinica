@extends('layouts.app')

@section('title', 'Lista de Médicos')

@section('content')
<div class="container">
	<div class='row'>
		<div class="col-sm-10">
			<div id="alertDeletetPaciente">
				
			</div>
			<form action="{{ route('medico.list') }}" method="post">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-sm-6">
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
					</div>
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
						<button type="submit" class="btn btn-primary" id="searchSubmit"> Pesquisar</button>
					</div>
				</div>
			</form>
			@if(isset($medicos) && count($medicos) == 0)
				<div class="alert alert-info" id="testFade">
	  				<strong>Sem resultas!</strong> Nenhum resultado encontrado para os dados informados acima.
				</div>
			@endif
			@if(isset($medicos) && (count($medicos) > 0))
				<div class="table-responsive">
	  				<table class="table" id="tableListMedicos">
	  					<div><p><strong>Total</strong>: {{ count($medicos) }} cadastro(s)</p></div> 
						<thead class="">
							<tr>
								<th scope="col">ID</th>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">CRM</th>
								<th scope="col" class="text-center">CBO</th>
								<th scope="col" class="text-center">Ação</th>
							</tr>
						</thead>
						<tbody id="medicos-list">
							@foreach ($medicos as $medico)
								<tr id="medico{{ $medico->idmedico }}">{{-- id de cada registro --}}
									<th scope="row">{{ $medico->idmedico }}</th>
									<td class="">{{ $medico->nome }}</td>
									<td class="text-center">{{ $medico->crm }}</td>
									<td class="text-center">{{ $medico->especialidade == null ? 'Não cadastrado': $medico->especialidade}}</td>
									<td class="text-center">

										<button type="button" 
												class="btn btn-info"
												data-toggle="modal"
			                                    data-target="#editMedicoModal"
			                                    data-id="{{$medico->idmedico}}"
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
								<th scope="col" class="text-center">CBO</th>
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
@endsection

@section('customer-javaScript')

{{-- <script> <script>--}}{{-- RETIRE O COMENTÁRIO DA TAG <SCRIPT> PARA VISUALIZAR O CÓDIGO COLORIDO --}} 

	//>>>BEGIN <<REQUEST FROM DATABASE>>
	//<<<END REQUEST FROM DATABASE
	//>>>BEGIN <<EDIT MODAL>>
        $(document).on('click','#tableEditButton', function(){
            var id = $(this).data('id');
			$('#medico-success').hide(1000);
            $.post('{{ route('medico.edit') }}', {id:id}, function(data){
                    //MASKARAS
				    //$('#editMedicoModal').find('#Icpf').mask('000.000.000-00');
				    //Mascara para telefone fixo
				    //$('#editMedicoModal').find('#ItelR').mask('(00)0000-0000');
				    //$('#editMedicoModal').find('#ItelE').mask('(00)0000-0000');
				    //Máscara para telefone celular
				    //$('#editMedicoModal').find('#ItelC').mask('(00)00000-0000');
               console.log(data)
                //LIMPA O FORMULÁRIO ANTES DE INSERIR AS INFORMAÇÕES
                $(':input','#form-edit-medico')
  				.not(':button, :submit, :reset, :hidden')
  				.val('')
  				.removeAttr('selected');
  				//INSERÇÃO DOS DADOS NO DEVIDOS CAMPOS/INPUTS
                $('#editMedicoModal').find('#IidPaci').val(data.idmedico);
                $('#editMedicoModal').find('#Inome').val(data.nome);
                $('#editMedicoModal').find('#Inasc').val(data.nascimento);
                //
                if(data[0].sexo == 'femenino' || data.sexo == 'FEMENINO'){
                	$('#editMedicoModal').find('#Isexo').val("femenino");
                }if(data[0].sexo == 'masculino' || data.sexo == 'MASCULINO'){
					$('#editMedicoModal').find('#Isexo').val("masculino");
            	}
            	//
                $('#editMedicoModal').find('#Icpf').val(data.cpf).mask('000.000.000-00');
				$('#editMedicoModal').find('#Icrm').val(data.crm);

				//TRATAMENTO PARA INSERIR OS DADOS DE CONTATOS CORRETAMENTE
					//for (var i = 0; i < data.length; i++) {
					    //if((data[i].tipo != null) && (data[i].numero != null)) {
					        //if(data[i].tipo == 'RES'){
					           // $('#editPacienteModal').find('#ItelR').val(data[i].numero).mask('(00)0000-0000');
					        //}if(data[i].tipo == 'EMP'){
					            //$('#editPacienteModal').find('#ItelE').val(data[i].numero).mask('(00)0000-0000');
					       // }if(data[i].tipo == 'CEL'){
					            //$('#editPacienteModal').find('#ItelC').val(data[i].numero).mask('(00)00000-0000');
					        //}
					    //}
					//}
				//
                $('#editMedicModal').find('#Iesp').val(data.especialidadeid);   
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
                    //console.log(data);
             		$('#editMedicoModal').show().scrollTop(0);
                    $('#medico-success').show("slow");
                    
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
                $('#deleteMedicoModal').find('input#Iid').val(data.idpaciente);
                $('#deleteMedicoModal').find('p#deleteModalId').html('<strong style="font-size:18px">ID:</strong> '+data.idmedico);
                $('#deleteMedicoModal').find('p#deleteModalNome').html('<strong style="font-size:18px">Nome:</strong> '+data.nome);
                $('#deleteMedicoModal').find('p#deleteModalNasc').html('<strong style="font-size:18px">Data Nascimento:</strong> '+data.nascimento);
                $('#deleteMedicoModal').find('p#deleteModalCpf').html('<strong style="font-size:18px">CPF:</strong> '+data.cpf);
				$('#deletePacienteModal').find('p#deleteModalCpf').html('<strong style="font-size:18px">CRM:</strong> '+data.crm);
                
                //------------------------------------------------------------------
                $('.modal-body').show();
                $('.modal-title').text('Deletar Cadasto');
                   console.log(data);
                });
        });
    //<<<END <<SHOW MODAL DELETE>>
    //>>>BEGIN <<DELETE PLANO NODEL>>
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
{{-- </script> --}}{{-- O SCRIPT SÓ IRÁ FUNCIONAR SE AS TAGS ESTIVEREM COMENTADAS --}}
@endsection