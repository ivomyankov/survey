<div class="col-12 bg-light rounded shadow p-4 my-4">
    <div class="row">
        @foreach($element as $key => $value)
            @if($key == 0)
                    <div class="col-12">
                        <b>{{$value->text}}</b>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="row d-flex justify-content-center">
                            @foreach($cols as $index => $col)                            
                                <div class="col-2 mx-2 mb-2" >
                                    <div class="row d-flex justify-content-center">{{$col[0]}} {{$col[1]}}</div>
                                    <div class="row bg-{{$col[2]}} p-1"></div>
                                </div>     
                            @endforeach
                        </div> 
                    </div>
            @elseif($value->type != 'col')        
                @if($element[0]->type == 'multy_radio')
                    <div class="col-sm-6">
                        <b>{{$value->id}} {{$value->text}}</b>
                        <ul>
                            @if($value->type == 'short_text' && array_key_exists('q'.$value->id.'_s', $results))
                                @foreach($results['q'.$value->id.'_s'] as $res)
                                    <li>{{$res}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="col-sm-6">                        
                        <div class="progress">
                            @if(array_key_exists($value->id, $result))
                                @foreach($result[$value->id] as $id => $res)
                                    @foreach($cols as $index => $col) 
                                        @if($col[0] == $id)                                        
                                            <div class="progress-bar bg-{{$col[2]}}" role="progressbar" style="width: {{round(($res/count($this->results['q'.$value->id]))*100, 1)}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">{{round(($res/count($this->results['q'.$value->id]))*100, 1)}}%</div>
                                        @endif
                                    @endforeach
                                @endforeach

                            @endif
                        </div>                        
                    </div>
                @else

                @endif
            @endif
        @endforeach
    </div>
</div>
<!-- ./col -->