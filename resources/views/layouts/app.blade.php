<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{--  <script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}" defer></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/costumer.css') }}" rel="stylesheet">
    <!--Extra links e scripts-->
     @yield('head')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div id="includes">
                @include('layouts._include._flash_message')
            </div>
            @yield('content')
        </main>
    </div>
 <script src="{{ asset('js/customer.js') }}" defer></script>

<script>    
    $(document).ready( function($){
        //csrf_token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        {{-- @yield('script') --}} 

        //>>>BEGIN <<EDIT MODAL>>
            $(document).on('click','#tableEditButton', function(){
                var id = $(this).data('id');
                var nome = $(this).data('nome');
                var status = $(this).data('status');

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

        //Máscara para o cpf
        $('#Icpf').mask('000.000.000-00');
        //Mascara para telefone fixo
        $('#ItelR').mask('(00)0000-0000');
        $('#ItelE').mask('(00)0000-0000');
        //Máscara para telefone celular
        $('#ItelC').mask('(00)00000-0000');
    });
    
//TELEPHONE MASK
//CPF MASK
</script>

</body>
</html>
