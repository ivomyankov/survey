<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- FontAwesome icons -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('vendor/jqvmap/jqvmap.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">

        <!-- Bootstrap 5 --> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    

        

        @livewireStyles

        <!-- Scripts 
        <script src="{{ mix('js/app.js') }}" defer></script>-->
        <style>
            .input-border {
                border: solid 2px #e0ccff;
            }

            .mark {
                display:    none;
                position:   absolute;
                margin-left:-15px;
                color:      red;
            }
        </style>
    </head>
    <body style="background-color: rgb(240, 235, 248);">
    {{--dd($errors->all())--}}

    @include('messages')

        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }} 
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- ChartJS -->
        <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('vendor/sparklines/sparkline.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('vendor/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('vendor/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('vendor/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
        <script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <!-- Summernote -->
        <script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('vendor/adminlte/dist/js/demo.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('vendor/adminlte/dist/js/dashboard.js') }}"></script>
        <!-- FLOT CHARTS -->
        <script src="{{ asset('vendor/flot/jquery.flot.js') }}"></script>
        <!-- Page specific script -->
        <script>
            $(document).ready(function () {
                // Each alert shows and hides one after another delayed by 1 sec
                $.each( $(".alert"), function(index) {
                    var delay = (index+2)*1000
                    $(this).fadeIn(1000).delay( delay ).fadeOut(1000);
                });

                @php
                foreach ($errors->all() as $error){
                    $q = str_replace(["The ", " field is required."], "", $error); 

                    echo "$('#$q').show();";
                }
                @endphp


            }); // End document ready
        </script>

        @livewireScripts

    </body>
</html>
