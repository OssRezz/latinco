<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    {{-- Animted Css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Datatables-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/dt-1.12.0/fc-4.1.0/fh-3.2.3/r-2.3.0/datatables.min.css" />
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/dt-1.12.0/fc-4.1.0/fh-3.2.3/r-2.3.0/datatables.min.js"></script>


    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
</head>

<body class="scrolly">
    <div class="container toasts" id="toats"></div>
    <div id="respuesta"></div>
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('components.sidebard')

        <div id="content">
            <!-- Menú del top -->
            @include('components.navbar')

            <div class="container-fluid px-4">
                @yield('content')

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/hbMenu.js') }}"></script>
</body>

</html>
