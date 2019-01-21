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
    <link href="{{ asset('/css/costumer.css') }}" rel="stylesheet">
    <!--Extra links e scripts-->
     @yield('head')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('consulta.create') }}">Agendamento de Consulta</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Cadastrar
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="#">Usuário</a>
                          <a class="dropdown-item" href="{{ route('paciente.create') }}">Paciente</a>
                          <a class="dropdown-item" href="{{ route('medico.create') }}">Médico</a>
                          <a class="dropdown-item" href="{{ route('especialidade.create') }}">Especialidade Médica</a>
                          <a class="dropdown-item" href="{{ route('plano.create') }}">Convênio</a>
                          <a class="dropdown-item" href="{{ route('agenda.create') }}">Agenda Médica</a>
                        </div>
                      </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Procurar Cadastro
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="#">Usuário</a>
                          <a class="dropdown-item" href="{{ route('paciente.findPaciente') }}">Paciente</a>
                          <a class="dropdown-item" href="{{ route('medico.find') }}">Médico</a>
                          <a class="dropdown-item" href="{{ route('especialidade.create') }}">Especialidade Médica</a>
                          <a class="dropdown-item" href="{{ route('plano.create') }}">Convênio</a>
                          <a class="dropdown-item" href="{{ route('agenda.create') }}">Agenda Médica</a>
                        </div>
                      </li>
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
                                        {{ __('Sair') }}
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
            <div class="col-md-10 col-md-offset-1 text-center">
               <h3 class="text-center">@yield('title')</h3> 
            </div>
            <div id="includes">
                
            </div>
            @yield('content')
        </main>
    </div>
<script>
$(document).ready( function($){
//csrf_token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @yield('customer-javaScript')
    //MASKARAS
    $('#Icpf').mask('000.000.000-00');
    //Mascara para telefone fixo
    $('#ItelR').mask('(00)0000-0000');
    $('#ItelE').mask('(00)0000-0000');
    //Máscara para telefone celular
    $('#ItelC').mask('(00)00000-0000'); 

    $('[data-load-remote]').on('click',function(e) {
        e.preventDefault();
        var $this = $(this);
        var remote = $this.data('load-remote');
        if(remote) {
            $($this.data('remote-target')).load(remote);
        }
    });

});
    
//TELEPHONE MASK
//CPF MASK
</script>
 <script src="{{ asset('/js/customer.js') }}"></script> 
</body>
</html>
