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

            </div>
        </div>
    </section>
@stop

@section('css')
    
@stop

@section('js')
    
@stop