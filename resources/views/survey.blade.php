@extends('layouts.public')

@section('title', 'Umfrage')

@section('header')

@stop

@section('content')
    <center><h1 class="p-5 m-5 text-success" style="display:none;"><i class="far fa-thumbs-up"></i>Vielen Dank für Ihre Teilnahme</h1></center>
    <center><h1 class="p-5 m-5 text-waring" style="display:none;"><i class="far fa-thumbs-down"></i>Versuchen Sie bitte später noch mal</h1></center>

    @if(session()->get('msg') == 'ok')
        <center><h1 class="p-5 m-5 text-success"><i class="far fa-thumbs-up"></i>Vielen Dank für Ihre Teilnahme</h1></center>
    @elseif(session()->get('msg') == 'error')
        <center><h1 class="p-5 m-5 text-waring"><i class="far fa-thumbs-down"></i>Versuchen Sie bitte später noch mal</h1></center>
    @else
        <form id=form action="{{-- route('submitSurvey',$survey->id) --}}" method="POST" style="max-width: 900px; margin: auto;">
            <input type="hidden" name="required" value="{{implode(',', $required)}}">

            <div class="d-flex justify-content-center">
                @if (in_array(substr_replace( $survey->name, '', -5 ), array("Aussteller", "Messebesucher", "Dienstleister") ))
<img src="{{ asset('/img/flotte.png') }}" style="float:left;margin-right: 50px;height: 100px;margin-top: 50px;" >
                @endif
                <h1 class="display-3 " >{{$survey->name}}</h1>
            </div>
            @if($elements)
                @foreach($elements as $element)
                    @livewire('front.form-builder', ['element'=>$element, 'options'=>$options ])
                @endforeach
                <div class="d-flex justify-content-center">
                    <button type="button" onclick="submtt()" class="btn btn-info w-25 my-5" value="Send" >Meine Antworten abschicken</button>
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
            margin-top: 4rem;
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

        .errorBorder {
            border: solid 2px red;
        }

        .error {
            color:#f00;
            font-size:12px;
        }

        .vertical-align-center{
            display: flex;
            align-items: center;  /*Aligns vertically center */
        }

    </style>
@endpush

@push('scripts')
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script>
        function submtt(){
            $( ".rounded" ).removeClass( "errorBorder" );
            $( ".error" ).text( '' );
            let errors = 0;

            /*if ( $(".last" ).length > 0 ) {
                if ( check('last') != true ){
                    return false;
                }
            } */

            $( ".percentage, .last" ).each(function() {
                errors = errors+checkSum( $(this).attr('id') );
            });

            if(errors == 0) {
                //alert('go');
                send();
            }
        };

        function checkSum(id) {
            try {
                var sum = 0;
                var elements = '';
                $('#' + id +' :input').each(function (index) {
                    sum += Number($(this).val());
                    elements = elements + ' + X' + (index+1);
                });
                if (sum != 100) {
                    $( "#"+id ).addClass( "errorBorder" );
                    $("#"+id+" > .error").text(elements.substring(3) + ' = ' + sum + '% < 100%');
                    throw 'Bitte korrigieren Sie Ihre Eingabe.';
                }
                //alert('send after check');
                //send();
                return 0;

            } // /try
            catch(err) {
                //alert(err);
                return 1;
            }

        } // / check()


        function send(){
            var data = {};
            let formData = new FormData(document.getElementById('form'));

            formData.forEach((value, key) => {
                // Reflect.has in favor of: object.hasOwnProperty(key)
                if(!Reflect.has(data, key)){
                    data[key] = value;
                    return;
                }
                if(!Array.isArray(data[key])){
                    data[key] = [data[key]];
                }
                data[key].push(value);
            });
            var json = JSON.stringify(data); //on stringified var we remove '[]' from keys => 'q90[]' to 'q90'
            console.log(json, 'zzz');

            $.ajax({
                url: "{{url('/')}}/api/h/{{$survey->hash_submit}}",
                method: "post",
                dataType: "json",
                data: json,
                contentType: "application/json",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer 6U1s6E2eZ54sm5eUgZEEqzHqng1BEYkovFc96wtL');
                },
                async: true,
                crossDomain: true,
                success: function (response) {
                console.log(response);
                //alert("Details saved successfully!!!");
                },
                error: function (xhr, status, error) {
                    alert(/*xhr+", "+xhr.status+", "+status+", "+error+"," +*/xhr.responseText);
                    getErrors(xhr.responseText);
                }
            })
            .done(function (data) {
            if(data.success){
                console.log("Thank you");
                $('.text-success').show();
                $(form).hide();
            }
            })
            .fail(function () {
                //alert("no good");
            });
        }


        function getErrors(responseText) {
            var err = JSON.parse(responseText);
            var mark = [];
            $.each(err.errors, function(name, val) {
                if (val == 'The '+ name +' field is required.'){
                    mark[name]=val;
                    //alert(mark[name]);
                    var id = name.substr(1);
                    $( "#"+id ).addClass( "errorBorder" );
                }
                //alert(name + ' / ' + val);
            });
            console.log("Mark: ", mark);
        }

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




        var data = JSON.parse('{!!json_encode($options)!!}');

        $('.opt').change(function() {
            var id = $(this).val();
            //alert(id);

            if (data.hasOwnProperty(id)) {
                //alert('show:' + data[id].show + ' / hide:' + data[id].hide);
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
                    $(data[id].hide.replace(/\#/g, '.q')).prop("checked", false).val('');
                }

            }

        });


        // if sonstigues is filled or emptied will check or uncheck
        $(".sonstiges").focusout(function(){
            var id = $(this).attr('id');
            id = id.substring(1).slice(0,-2);
            var val = $(this).val();
            if(val != ''){
                $( "#"+id ).prop( "checked", true );
            } else {
                $( "#"+id ).prop('checked', false);
            }

        });

        //if check/radio infront sonstigues is not checked will empty sonstigues
        $("input[type=checkbox], input[type=radio]").change(function () {
            var questionId = $(this).attr('alt');
            if ($("#"+questionId+" .sons").length > 0){
                let sons = $("#"+questionId+" .sons").attr("id");
                if(!$("#"+sons).is(':checked')){
                    $('#q'+sons+'_s').val('');
                }
            }
        });


        $(document).ready(function () {

        });

        function processAjaxRequest(type, formData, formUrl){
            if (type == '' || formData == '' || formUrl == ''){
                return false;
            }

            return $.ajax({
                url: formUrl,
                type: "POST",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                dataType: type,
                cache: false,
                processData: false,
                async: true
            });
        }


    </script>
@endpush
