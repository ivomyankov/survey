<div id="{{$element[0]->id}}" class="percentage rounded shadow bg-light p-4 position-relative {{ $element[0]->visible === 0 ? 'hidden' : '' }} mt-5" alt="{{$element[0]->id}}">{{--dd($element)--}}
    @if($element[0]->required == 1)
        <i class="text-danger position-absolute trquired" style="top:5px; right:10px;">required</i>
    @endif
    

    @foreach($element as $key => $option)
        @if($key==0)
            <b>{{$element[0]->text}}</b>
            <br>
            <i>Prozentangabe bitte in das jeweilige offene Feld eintragen</i>            
            
        @else    
            <div class="form-check px-4 my-2" style="background-color: #f8f9fa;" alt="{{$option->id}}">                     
                <label class="form-check-label w-100" for="q{{$element[0]->id}}_{{$option->position}}">      
                    <input class="form-input q{{$element[0]->id}} input-border" min="0" max="100" value="0" name="q{{$element[$key]->id}}" id="{{$element[$key]->id}}" style="width:50px" type="number" >
                    % &nbsp; {{$option->text}} 
                </label>
            </div>
        @endif
    @endforeach
    <i class="error"></i>
</div>