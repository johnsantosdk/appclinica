/**
$(document).ready( function($){
        //csrf_token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        {{-- @yield('script') --}} 

        //BEGIN <<EDIT MODAL>>
            $(document).on('cllick','planos-list #edit', function(){
                var id = $(this).data('id');
                var nome = $(this).data('nome');
                var status = $(this).data('status');

                $.post('{{ route('plano.editPlano') }}', {id:id}, function(data){
                    $('#editPlanoModal').find('#Iid').value(data.id);
                    $('#editPlanoModal').find('#Inome').value(data.nome);
                    $('#editPlanoModal').find('#Istatus').value(data.status);
                
                    $('#editPlanoModal').modal('show');
                    $('#form-edit-plano').show();
                    $('.modal-title').text('Editar Plano');
                });
            });
        //END EDIT MODAL
    });
**/

$(":input").inputmask();

$("#phone").inputmask({"mask": "(999) 999-9999"});