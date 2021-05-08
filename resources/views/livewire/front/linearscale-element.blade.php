<div class="rounded shadow bg-light p-4 position-relative">{{--dd($element)--}}
    @if($element[0]->required == 1)
        <i class="text-danger position-absolute trquired" style="top:5px; right:10px;">required</i>
    @endif
    

    @foreach($element as $key => $option)
        @if($key==0)
            {{$element[0]->id}} {{$element[0]->text}}
            @if($element[0]->type == 'checkbox')
                <i>(Mehrfachnennungen möglich)</i>
            @endif
        @endif
    @endforeach     
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-sm-{{$scaleSide}} text-end">&nbsp;<br>{{$bothOptions[0]->id}} {{$bothOptions[0]->text}} </div>
                    @for($i = 1; $i<=$element[0]->options; $i++)
                        <div class="col-sm-1 text-center">
                            {{$i}} 
                            <br>
                            <input class="form-check-input" type="radio" value="{{$i}}" name="q{{$element[0]->id}}" id="q{{$element[0]->id}}_{{$i}}">
                        </div>
                    @endfor
                <div class="col-sm-{{$scaleSide}}">&nbsp;<br>{{$bothOptions[1]->id}} {{$bothOptions[1]->text}}</div>
            </div>
</div>