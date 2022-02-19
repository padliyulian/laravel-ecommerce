
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$title ?? 'Seler | Ecom'}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/images/logo.png')}}" type="image/x-icon"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/icheck-bootstrap.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{-- inline CSS --}}
    @yield('inline-css')
</head>
    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="wrapper">
            @include('layouts._navbar')

            @include('layouts._sidebar')

            @yield('content')

            @include('layouts._rightbar')

            @include('layouts._footer')
        </div>

        <!-- jQuery -->
        <script src="{{asset('assets/adminlte/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('assets/adminlte/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('assets/adminlte/adminlte.min.js')}}"></script>
        <script>
            if (window.innerWidth < 900) {
                $('.sidebar .nav-link.lsp').on('click', function() {
                    $('.sidebar-mini').removeClass('sidebar-open')
                    $('.sidebar-mini').addClass('sidebar-collapse')
                })
            }
        </script>
        <!-- inline JS -->
        @yield('inline-js')
    </body>
</html>
