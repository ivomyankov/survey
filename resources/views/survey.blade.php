@extends('layouts.public')

@section('title', 'test')

@section('header')
   
@stop

@section('content') 

    @if(session()->get('msg') == 'ok')
        <center><h1 class="p-5 m-5 text-success"><i class="far fa-thumbs-up"></i> Thank you for your participation</h1></center>
    @elseif(session()->get('msg') == 'error')
        <center><h1 class="p-5 m-5 text-waring"><i class="far fa-thumbs-down"></i> Something went wrong. Please try later.</h1></center>
    @else
        <form class="py-5" action=" {!! route('submitSurvey',$survey->id) !!}" method="POST" style="max-width: 900px; margin: auto;">
            @csrf
            <input type="hidden" name="required" value="{{implode(',', $required)}}">
            <div class="d-flex justify-content-center">
                <h1 class="display-1 text-info" >{{$survey->name}}</h1>
            </div>
            @if($elements)
                @foreach($elements as $element)
                    @livewire('front.form-builder', ['element'=>$element, 'options'=>$options ])                  
                @endforeach            
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-info w-25 my-5" value="Send" ><< Weiter >></button>
                </div>
            @endif
        </form>
    @endif 
@stop

@push('styles')
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <style>
        h1, h2 {
            color: #555;
        }

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
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script>        
        $(function () {
            'use strict'

            // Make the dashboard widgets sortable Using jquery UI
            $('.connectedSortable').sortable({
                placeholder: 'sort-highlight',
                connectWith: '.connectedSortable',
                handle: '.card-header, .nav-tabs',
                forcePlaceholderSize: true,
                zIndex: 999999
            });
            $('.connectedSortable .card-header').css('cursor', 'move');

        });
/*
        $('input[type=radio]').change(function() {
            if (this.value == 186) {
                if ($(this).is(':checked')) {
                    $('#202,#205,#169,#176,#193').fadeOut();
                }
            } else if (this.value == 187) {
                if ($(this).is(':checked')) {
                    $('#202').fadeIn();
                    $('#205,#169,#176').fadeOut();
                }
            }
            if ($('#188').is(':checked')) {
                alert(188);
            }
        });
*/
        

        var data = JSON.parse('{!!json_encode($options)!!}');

        $('.opt').change(function() {
            var id = $(this).val();            
            //alert(id);            
            
            if (data.hasOwnProperty(id)) {                
                //alert(data[id].show + ' / ' + data[id].hide);
                if(data[id].show !== undefined){
                    //alert(data[id].show);
                    //if is checkbox and not checked then hide the the id's from hide field 
                    if($(this).is(':checkbox') && !$(this).is(':checked')){
                        $(data[id].show).fadeOut();
                    } else {
                        $(data[id].show).fadeIn();
                    }                    
                }
                if(data[id].hide !== undefined){
                    //alert(data[id].hide);
                    $(data[id].hide).fadeOut();
                    //alert(data[id].hide.replace(/\#/g, '.q'));
                    $(data[id].hide.replace(/\#/g, '.q')).prop("checked", false);
                }

            }    

        });

        $('.sons').change(function() {
            var id = $(this).attr('id');
            if(!$(this).is(':checked') && !$(this).is(':text')){
                $('#q'+id+'_s').val('');
            }
        });

        $(".sonstiges").focusout(function(){
            var id = $(this).attr('id');
            id = id.substring(1).slice(0,-2);
            var val = $(this).val();
            if(val != ''){ alert('time has come');
                $( "#"+id ).prop( "checked", true );
            } else {
                $( "#"+id ).prop('checked', false);
            }

        });

        
    </script>
@endpush