<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        {{--<link rel="stylesheet" href="{{ asset('assets/fullcalendar/fullcalendar.min.css') }}">--}}
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <title>Chatsford Retirement Village</title>
        @stack('head')
    </head>
    <body>

        <div id="wrapper">
            <div class="container mt-5">

                @include('layout.notificationbar')
                
                @if(auth()->user()->isManagement())
                    @include('auth.management.sidebar')
                @elseif(auth()->user()->isResident())
                    @include('auth.residents.sidebar')
                @elseif(auth()->user()->isMaintenance())
                    @include('auth.maintenance.sidebar')
                @endif

                @yield('content')
            </div>
         </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        {{--<script src="{{ asset('assets/fullcalendar/lib/jquery.min.js')}}"></script>--}}
        {{--<script src="{{ asset('assets/fullcalendar/lib/moment.min.js')}}"></script>--}}
        {{--<script src="{{ asset('assets/fullcalendar/fullcalendar.min.js')}}"></script>--}}
        {{--<script src="{{ asset('assets/fullcalendar/calendar.js')}}"></script>--}}
        <!-- Menu Toggle Script -->
        <script>
            $("#wrapper").on("click", "#menu-toggle", function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
        @stack('scripts')
    </body>
</html>
