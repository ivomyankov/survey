@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Results</h1>
@stop

@section('content')
    
    <section class="content">
      <div class="container">

        <div class="row">
          @foreach($surveyTree as $element)
            @if($element[0]->parent_id == 0)
              @if($element[0]->type == 'checkbox' || $element[0]->type == 'radio')
                @livewire('results.checkbox', ['element'=>$element, 'results'=>$results])
              @elseif($element[0]->type == 'multy_checkbox' || $element[0]->type == 'multy_radio')
                @livewire('results.multy-option', ['element'=>$element, 'results'=>$results])
              @elseif($element[0]->type == 'linear_scale')
                @livewire('results.linear', ['element'=>$element, 'results'=>$results])
              @elseif($element[0]->type == 'short_text' || $element[0]->type == 'long_text')
                @livewire('results.text', ['element'=>$element, 'results'=>$results])
              @endif
            @endif
          @endforeach
        </div>
        <!-- /.row -->
        
        
      </div><!-- /.container-fluid -->
    </section>
@stop

@section('css')
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
@stop

@section('js')
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

@stop