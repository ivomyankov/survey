@extends('adminlte::page')

@section('title', 'Survey')

@section('content_header')
    <h1>Survey <a href="{{ URL::route('newSurvey') }}" class="btn btn-primary float-right" role="button"><i class="fas fa-plus"></i> New survey</a></h1>
    
@stop

@section('content')
<br>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                @foreach($surveys as $survey)
                    <div class="col-12 col-sm-6 col-md-4">
                        <!-- small box -->
                        <div class="small-box bg-{{$colors[array_rand($colors, 1)]}}">
                            <div class="inner">
                                <h3>{{count($survey->data)}}</h3>

                                <p>#{{$survey->id}}: {{$survey->name}}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-toilet" onclick="flush({{$survey->id}})" style="position: absolute; right: 90px; font-size: 30px;"></i>
                                <i class="fas fa-poll"></i>
                            </div>
                            <a href="{{ URL::route('getSurvey', ['survey'=>$survey->id]) }}" class="small-box-footer" style="display: inline-block; width:49%;">to survey <i class="fas fa-arrow-circle-right"></i></a>
                            <a href="{{ URL::route('getResults', ['survey'=>$survey->id]) }}" class="small-box-footer" style="display: inline-block; width:49%;">to results <i class="fas fa-arrow-circle-right"></i></a>
                            <a href="{{ URL::route('hashUrl', ['hash'=>$survey->hash_survey]) }}" class="small-box-footer" style="display: inline-block; width:49%;">public form <i class="fas fa-arrow-circle-right"></i></a>
                            <a href="{{ URL::route('hashUrl', ['hash'=>$survey->hash_results]) }}" class="small-box-footer" style="display: inline-block; width:49%;">public results <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                @endforeach
                <div id="approve" class="shadow mx-auto col-md-8 text-center my-4" style="z-index: 9999; display:none">
                    <h2>Are you sure you want to flush the results of survey <span id="surveyToFlush"></span></h2>
                    <button onclick="cancel()" class="btn btn-success float-left m-5 px-4" role="button"><i class="fas fa-eject"></i> Cancel</button>
                    <a id="linkToFlush" href="" class="btn btn-danger float-right m-5 px-4" role="button"><i class="fas fa-toilet"></i> Flush</a>
                </div>
            </div>
            
        </div>
    </section>
@stop

@section('css')
    
@stop

@section('js')
    <script>
        function flush(id){
            $("#approve").fadeIn();
            $("#surveyToFlush").text("#"+id);
            $("#linkToFlush").attr("href", '{{URL::to('/')}}/dashboard/flush/'+id); // Set herf value
        }

        function cancel(){
            $("#approve").fadeOut();
            $("#surveyToFlush").text("#"+id);
        }
    </script>
@stop