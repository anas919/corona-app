<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/fav.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    <!-- Sidebar -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/sidebar.css')}}">

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!--plugins-->
    <link href="{{ asset('js/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <script src="{{ asset('js/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables.bootstrap4.min.js') }}"></script>
    <!--plugins-->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
</head>
<body>
    <div id="app">
        {{-- navigation bar --}}
        <div class="container-fluid mr-0 ml-0 mb-0 mt-0 pr-0 pl-0 pb-0 pt-0 no-print">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="Espace Engineering" width="50px">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    </div>
                </div>
            </nav>
        </div>
        {{-- midle part side bar plus main section  --}}
        <div class="app_container">
            {{-- sidebare only for online user --}}
            <nav id="sidebar" class="no-print" style="height: auto;">
                <div class="p-4 pt-5">
                    <a href="{{url('/')}}/" class="img logo rounded-circle mb-5" style="background-image: url({{asset('img/logo.png')}});background-size:contain;">
                    </a>

                    <ul class="list-unstyled components mb-5">
                        <li class="{{ (request()->is('users')) ? 'active' : '' }}">
                            <a href="{{url('/')}}/users">Utilisateurs</a>
                        </li>
                    </ul>
                    {{-- <div class="footer">
                        <p>
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                        </p>
                    </div> --}}
                </div>
            </nav>
            {{-- the main section for pages --}}
            <div class="app_page">
                @if ($message = Session::get('success'))
                    <div style="width: fit-content;" class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('errors'))
                    <div style="width: fit-content;" class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{!! $message !!}</strong>
                    </div>
                @endif
                @include('layouts.alert')
                <div id="loading" style="display: none;">
                    <div class="modal-backdrop fade show"></div>
                    <div class="fade show loading">
                        <img id="loading-img" src="{{asset('img/loading.gif')}}" alt="Loading">
                    </div>
                </div>
                <div id="modal-effect" style="display: none;">
                    <div class="modal-backdrop fade show"></div>
                    <div class="fade show loading"></div>
                </div>
                @yield('content')
            </div>
        </div>
        {{-- footer --}}
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>      
@yield('scripts')
</body>
</html>
