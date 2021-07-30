<div class="rounded shadow bg-light p-4 position-relative {{ $element[0]->visible === 0 ? 'hidden' : '' }} mt-5" id="{{$element[0]->id}}">{{--dd($element)--}}
    @if($element[0]->required == 1)
        <i class="text-danger position-absolute trquired" style="top:5px; right:10px;">required</i>
    @endif

    @foreach($element as $key => $option)
        @if($key==0)
            <b>{{$element[0]->text}}</b>
            <br><i>Bitte vergeben Sie Noten von 1-5 für die Maßnahmen: „1“ bedeutet „sehr sinnvoll“ und „{{$scale}}“ bedeutet „nicht sinnvoll“. Selbstverständlich können Sie auch alle Noten dazwischen vergeben</i>
        @else
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-sm-{{ $scale < 7 ? (12-$scale) : 12 }} vertical-align-center">{{$element[$key]->text}}</div>
                @for($i = 1; $i<=$scale; $i++)
                    <div class="col-1 text-center position-relative">
                        {{$i}} 
                        <br>
                        <input class="form-check-input q{{$element[$key]->id}}" type="radio" value="{{$i}}" name="q{{$element[$key]->id}}" >
                    </div>
                @endfor
            </div>
        @endif
    @endforeach     
</div>