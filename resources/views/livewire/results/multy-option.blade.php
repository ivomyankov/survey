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
                    @if($v==1)
                        <div class="col-sm-3 my-2"> 
                            @foreach($cols as $i => $col)
                                @if(array_key_exists($value->id, $result) &&  array_key_exists($col[0], $result[$value->id]))
                                    <div class="progress my-2">
                                        <div class="progress-bar bg-{{$col[2]}} pl-1 text-left" role="progressbar" aria-valuenow="{{round(($result[$value->id][$col[0]]/count($results['q'.$value->id]))*100, 1)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round(($result[$value->id][$col[0]]/count($results['q'.$value->id]))*100, 1)}}%">
                                            <span class="d-none">{{round(($result[$value->id][$col[0]]/count($results['q'.$value->id]))*100, 1)}}% </span>
                                        </div>
                                    </div>
                                    @else
                                    <div class="progress my-2">
                                        <div class="progress-bar bg-{{$col[2]}} pl-1 text-left" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            <span class="d-none">0% </span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach   
                        </div>
                        <div class="col-sm-1 my-2 text-right pr-3">
                            @foreach($cols as $i => $col)
                                @if(array_key_exists($value->id, $result) &&  array_key_exists($col[0], $result[$value->id]))
                                    {{round(($result[$value->id][$col[0]]/count($results['q'.$value->id]))*100, 1)}}%
                                @else
                                    0%<br>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-sm-8 my-2"> {{$value->id}} {{$value->text}} 
                            @if($value->type == 'short_text' && array_key_exists('q'.$value->id.'_s', $results))
                                Sonstiges:
                                <ul>
                                    @foreach($results['q'.$value->id.'_s'] as $res)
                                        <li>{{$res}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>   
                    @else
                        <div class="col-sm-3 mt-3"> 
                            <div class="row">
                                @foreach($cols as $i => $col)
                                    @if(array_key_exists($value->id, $result) &&  array_key_exists($col[0], $result[$value->id]))
                                        <div class="progress vertical"> 
                                            <div class="bar bg-{{$col[2]}}" style="height: {{round(($result[$value->id][$col[0]]/count($results['q'.$value->id]))*100, 1)}}%;width:100%;position: absolute; bottom: 0;"></div>
                                            <span class="position-absolute text-{{$col[2]}}" style="bottom: {{round(($result[$value->id][$col[0]]/count($results['q'.$value->id]))*100)+5}}%; left:0;">{{round(($result[$value->id][$col[0]]/count($results['q'.$value->id]))*100, 1)}}%</span>
                                        </div>
                                    @else
                                        <div class="progress vertical">
                                            <span class="text-{{$col[2]}}" style="position: absolute; bottom: 10px; left:30%;">0%</span>
                                        </div>
                                    @endif
                                @endforeach                            
                            </div>
                            <div class="row">
                                {{$value->id}} {{$value->text}} 
                                @if($value->type == 'short_text' && array_key_exists('q'.$value->id.'_s', $results))
                                    Sonstiges:
                                    <ul>
                                        @foreach($results['q'.$value->id.'_s'] as $res)
                                            <li>{{$res}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>    
                    @endif
                @endif
            @endif
        @endforeach
    </div>
</div>
<!-- ./col -->