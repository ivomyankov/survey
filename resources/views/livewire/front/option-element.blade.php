<div id="{{$element[0]->id}}" class="zz rounded shadow bg-light p-4 position-relative {{ $element[0]->visible === 0 ? 'hidden' : '' }} mt-5" alt="{{$element[0]->id}}">{{--dd($element)--}}
    @if($element[0]->required == 1)
        <i class="text-danger position-absolute trquired" style="top:5px; right:10px;">required</i>
    @endif
    

    @foreach($element as $key => $option)
        @if($key==0)
            <b>{{$element[0]->text}}</b>
            
            @if($element[0]->type == 'checkbox')
                <i>(Mehrfachnennungen möglich)</i>            
            @endif
        @else    
            <div class="form-check px-4 my-2" style="background-color: #f8f9fa;" alt="{{$option->id}}">
                <input class="form-check-input q{{$element[0]->id}} {{ $option->type === 'short_text' ? 'sons' : ''}} {{ $option->opt != NULL ? 'opt' : ''}}" type="{{$element[0]->type}}" value="{{$option->id}}" name="q{{$element[0]->id}}" alt="{{$element[0]->id}}" id="{{$option->id}}">
                <label class="form-check-label w-100" for="q{{$element[0]->id}}_{{$option->position}}">                    
                    {{$option->text}} 
                    @if($option->type == 'short_text')
                        <input class="w-100 input-border {{ $option->type === 'short_text' ? 'sonstiges' : ''}}" type="text" name="q{{$option->id}}_s" alt="{{$element[0]->id}}s" id="q{{$option->id}}_s" placeholder="Sonstiges:">
                    @endif
                </label>
            </div>
        @endif
    @endforeach
</div>
