@extends('layouts.public')

@section('title', 'exit')

@section('header')
   
@stop

@section('content') 
    {{--dd($msg, $log)--}}
    @if($msg == 'ok')
    <center><h1 class="p-5 m-5 text-success"><i class="far fa-thumbs-up"></i> Thank you for your participation</h1></center>
    @else
        <center><h1 class="p-5 m-5 text-waring"><i class="far fa-thumbs-down"></i> Something went wrong. Please try later.</h1></center>
    @endif   
@stop

@push('styles')
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <style>
        #survey-options-menu li{
            display: block;  
            text-align: center;
            padding: 5px;
        }

        #survey-options-menu li i{
            cursor: pointer;
        }

        #survey-options-menu{
            margin: 0;
            padding: 0;
        }

        .disabled {
            pointer-events: none;
            opacity: 0.4;
        }

        .hidden {
            display:none;
        }

    </style>
@endpush

@push('scripts')
    <script>        
      console.log('{!!$log->data!!}');
    </script>
@endpush