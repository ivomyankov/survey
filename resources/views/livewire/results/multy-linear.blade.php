<div class="col-12 bg-light rounded shadow p-4 my-4">{{--dd($result, $devide)--}}
    @foreach($element as $key => $option)
        @if($key==0)
            <div class="row">  
                <b>{{$element[0]->text}}</b>
                <br><i>Bitte vergeben Sie Noten von 1-5 für die Maßnahmen: „1“ bedeutet „sehr sinnvoll“ und „{{$scale}}“ bedeutet „nicht sinnvoll“. Selbstverständlich können Sie auch alle Noten dazwischen vergeben</i>
            </div>
        @else
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-sm-{{ $scale < 7 ? (12-$scale) : 12 }} vertical-align-center">{{$element[$key]->text}}</div>
                @for($i = 1; $i<=$scale; $i++)
                    <div class="col-1 text-center position-relative">
                        @if(isset($result[$key][$i]))
                            <div class="progress vertical">
                                <div class="bar bg-info" style="height: {{round(($result[$key][$i]/$devide[$key])*100, 1)}}%;width:100%;position: absolute; bottom: 0;"></div>
                                <span class="position-absolute text-info" style="bottom: {{round(($result[$key][$i]/$devide[$key])*100)+5}}%; left:0;">{{round(($result[$key][$i]/$devide[$key])*100, 1)}}%</span>
                            </div>
                        @else
                            <div class="progress vertical">
                                <span class="text-info" style="position: absolute; bottom: 10px; left:30%;">0%</span>
                            </div>
                        @endif
                        <br>{{$i}} 
                    </div>
                @endfor
            </div>
        @endif
    @endforeach   
</div>