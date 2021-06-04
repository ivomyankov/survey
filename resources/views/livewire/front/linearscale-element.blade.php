<div class="rounded shadow bg-light p-4 position-relative {{ $element[0]->visible === 0 ? 'hidden' : '' }} mt-5" id="{{$element[0]->id}}">{{--dd($element)--}}
    @if($element[0]->required == 1)
        <i class="text-danger position-absolute trquired" style="top:5px; right:10px;">required</i>
    @endif
    

    @foreach($element as $key => $option)
        @if($key==0)
            {{$element[0]->text}}
            @if($element[0]->type == 'checkbox')
                <i>(Mehrfachnennungen möglich)</i>
            @endif
        @endif
    @endforeach     
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-{{$scaleSide}} text-end" alt="{{$bothOptions[0]->id}}">{{$bothOptions[0]->text}}</div>
                    @for($i = 1; $i<=$scale; $i++)
                        <div class="col-1 text-center">
                            {{$i}} 
                            <br>
                            <input class="form-check-input q{{$element[0]->id}}" type="radio" value="{{$i}}" name="q{{$element[0]->id}}" >
                        </div>
                    @endfor
                <div class="col-{{$scaleSide}}" alt="{{$bothOptions[1]->id}} ">{{$bothOptions[1]->text}}</div>
            </div>
</div>