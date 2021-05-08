@extends('adminlte::page')

@section('title', 'Survey')

@section('content_header')
    @livewire('survey-name', ['qid'=>$survey->id, 'name'=>$survey->name])

    
    
    
@stop

@section('content')
    {{--dd($survey)--}}

    @livewire('survey-component', ['survey'=>$survey->id])            
      
@stop

@section('css')
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

    </style>
@stop

@section('js')
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
            
            $( ".connectedSortable" ).sortable({
                update: function( event, ui ) {
                    alert(ui.item.attr("id"));
                }
            });

        });

        // jQuery UI sortable for the todo list
        $('.todo-list').sortable({
            placeholder: 'sort-highlight',
            handle: '.handle',
            forcePlaceholderSize: true,
            zIndex: 999999
        });



        $("#sortable,#sortable2").sortable({
            //stop: function(event, ui) {
                //alert("New position: " + ui.item.index());
            //}
            start: function(e, ui) {
                // creates a temporary attribute on the element with the old index
                $(this).attr('data-previndex', ui.item.index());
            },
            update: function(e, ui) {
                // gets the new and old index then removes the temporary attribute
                var newIndex = ui.item.index();
                var oldIndex = $(this).attr('data-previndex');
                var element_id = ui.item.attr('id');
                var element_alt = ui.item.attr('alt');
                alert('id of Item moved = ' + element_id + ' old position = ' + oldIndex + ' new position = ' + newIndex + ' parent = ' + element_alt);
                $(this).removeAttr('data-previndex');
            }
        });
        $("#sortable").disableSelection();
    </script>
@stop