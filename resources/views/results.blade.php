<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">              
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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

        <style>
            .vertical-align-center{ 
                display: flex; 
                align-items: center;  /*Aligns vertically center */
                justify-content: center; /*Aligns horizontally center */
            }
        </style>

        @livewireStyles
    </head>
    <body style="background-color: rgb(240, 235, 248);">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="p-2">{{ $survey->name }} </h2>
            </div>
        </header>
        <section class="content">
            <div class="container">
                @if(!empty($results)) 
                    <div class="row">
                    @if($surveyTree)
                        @foreach($surveyTree as $element)
                            @if($element[0]->parent_id == 0)
                                @if($element[0]->type == 'checkbox' || $element[0]->type == 'radio')
                                    @livewire('results.checkbox', ['element'=>$element, 'results'=>$results])
                                @elseif($element[0]->type == 'multy_checkbox' || $element[0]->type == 'multy_radio')
                                    @livewire('results.multy-option', ['element'=>$element, 'results'=>$results])
                                @elseif($element[0]->type == 'linear_scale')
                                    @livewire('results.linear', ['element'=>$element, 'results'=>$results])
                                @elseif($element[0]->type == 'multy_linear')
                                    @livewire('results.multy-linear', ['element'=>$element, 'results'=>$results])
                                @elseif($element[0]->type == 'short_text' || $element[0]->type == 'long_text')
                                    @livewire('results.text', ['element'=>$element, 'results'=>$results])
                                @elseif($element[0]->type == 'percentage')
                                    @livewire('results.percentage-element', ['element'=>$element, 'results'=>$results])
                                @elseif($element[0]->type == 'final_question')
                                    @livewire('results.final-question', ['element'=>$element, 'results'=>$results])
                                @endif
                            @endif
                        @endforeach
                    @else
                        <div class="bg-light rounded shadow p-5 my-5 d-flex justify-content-center">
                            <h2>No results yet</h2>
                        </div>       
                    @endif
                    </div>
                    <!-- /.row -->
                @else
                    <h2 class="m-5 p-5">No results yet</h2>
                @endif
            
            </div><!-- /.container-fluid -->
        </section>

        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

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

        @livewireScripts
    </body>
</html>
