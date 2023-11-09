@extends('adminlte::page')

@section('title', 'Survey')

@section('content_header')
    @livewire('survey-name', ['qid'=>$survey->id, 'name'=>$survey->name])

@stop

@section('content')
    {{--dd($survey)--}}

    @livewire('survey-builder', ['survey'=>$survey->id])            
      
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

        .mobile-hidden{
            display:none;
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
            /*stop: function(event, ui) {
                //alert("New position: " + ui.item.index());
            }*/
            start: function(e, ui) {
                // creates a temporary attribute on the element with the old index
                $(this).attr('data-previndex', ui.item.index());
            },
            update: function(e, ui) {
                // gets the new and old index then removes the temporary attribute
                var newIndex = ui.item.index();
                var oldIndex = $(this).attr('data-previndex');
                var element_id = ui.item.attr('id');
                var parent = ui.item.attr('alt');
                var replaced = ui.item.prev();
                //alert('id of Item moved = ' + element_id + ' old position = ' + oldIndex + ' new position = ' + newIndex + ' parent = ' + parent);
                reposition(element_id, newIndex, parent);
                $(this).removeAttr('data-previndex');
            }
        });
        $("#sortable").disableSelection();

        function reposition(element_id, newIndex, parent){
            //alert(element_id + ' / ' + newIndex + ' / ' + parent);
            
            $.ajax({
                type: "patch",
                url: "{{ URL::route('reposition', ['survey'=>$survey->id]) }}",
                dataType: "json",
                contentType: 'application/json',
                processData: false,
                data: JSON.stringify({"element_id": element_id, "newIndex": newIndex, "parent": parent}),
                headers: {
                    Authorization: 'Bearer 6U1s6E2eZ54sm5eUgZEEqzHqng1BEYkovFc96wtL'
                },
                success: function (msg) {
                    //alert("New order updated");
                    //$("#msg").html("New order updated");
                    //$("#msg").fadeIn(2000);
                    
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });

        }

        $('.goto').change(function() {
            //alert($(this).attr('id') + ' | ' + $(this).val() + "{{url('api/element/')}}/" + $(this).attr('id') + "/goto");
            
            $.ajax({
                type: "patch",
                url: "{{url('api/element/')}}/" + $(this).attr('id') + "/goto",
                dataType: "json",
                contentType: 'application/json',
                processData: false,
                data: JSON.stringify({"go_to": $(this).val() }),
                headers: {
                    Authorization: 'Bearer 6U1s6E2eZ54sm5eUgZEEqzHqng1BEYkovFc96wtL'
                },
                success: function (msg) {
                    console.log(msg);
                    //alert("New order updated");
                    //$("#msg").html("New order updated");
                    //$("#msg").fadeIn(2000);
                    
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });

        $( ".show, .hide" ).focusout(function() {
            if($( this ).attr('name') === 'show'){
                var json = JSON.stringify({'go_to':{ 'show': $( this ).val() }});
            } else if($( this ).attr('name') === 'hide'){
                var json = JSON.stringify({'go_to':{ 'hide': $( this ).val() }});
            }
            $.ajax({
                type: "patch",
                url: "{{url('api/element/')}}/" + $(this).attr('alt') + "/opt",
                dataType: "json",
                contentType: 'application/json',
                processData: false,
                data: json,
                headers: {
                    Authorization: 'Bearer 6U1s6E2eZ54sm5eUgZEEqzHqng1BEYkovFc96wtL'
                },
                success: function (msg) {
                    console.log(msg);                    
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    </script>
@stop