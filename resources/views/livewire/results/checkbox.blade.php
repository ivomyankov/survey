<div class="col-12 bg-light rounded shadow p-4 my-4">
    <div class="row">
        @foreach($element as $key => $value)
            @if($key == 0)
                <div class="col-12">
                    <b>{{$value->text}}</b>
                </div>
            @else
                <div class="col-9 col-sm-3 pt-1"> 
                    @if(array_key_exists($value->id, $result))
                        <div class="progress">
                            <div class="progress-bar bg-info pl-1 text-left" role="progressbar" aria-valuenow="{{round(($result[$value->id]/$devide)*100)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round(($result[$value->id]/$devide)*100)}}%">
                                <span class="d-none">{{round(($result[$value->id]/$devide)*100, 1)}}% </span>
                            </div>
                        </div>
                    @else
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                    @endif
                </div>
                <div class="col-3 col-sm-1 text-right pr-3">
                    @if(array_key_exists($value->id, $result))
                        {{round(($result[$value->id]/$devide)*100, 1)}}%
                    @else
                        0%
                    @endif
                </div>
                <div class="col-sm-8">{{$value->id}} 
                    @if($value->type == 'short_text' && isset($results['q'.$value->id.'_s']))
                        Sonstiges:
                    @else    
                        {{$value->text}}
                    @endif
                </div>
                @if($value->type == 'short_text' && isset($results['q'.$value->id.'_s']))
                    <div class="col-0 col-sm-4"></div>
                    <div class="col-12 col-sm-8">
                        <ul>
                            @foreach($results['q'.$value->id.'_s'] as $val)
                                <li> {{$val}}</li> 
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
</div>
<!-- ./col -->