<div id="{{$element[0]->id}}" class="rounded shadow bg-light p-4 position-relative {{ $element[0]->visible === 0 ? 'hidden' : '' }} mt-5" alt="{{$element[0]->id}}">
{{--dd($element)--}}
    @if($element[0]->required == 1)
        <i class="text-danger position-absolute trquired" style="top:5px; right:10px;">required</i>
    @endif
    
    {{$element[0]->text}}  
    <div class="form-check px-0 my-2" style="background-color: #f8f9fa;" >
        <div class="col-12 pb-3">
            <input class="form-input q{{$element[0]->id}} input-border last" min="0" max="100" value="0" name="q{{$element[1]->id}}" id="{{$element[1]->id}}" style="width:50px" type="number" >
            % auf PKW , 
            <input class="form-input q{{$element[0]->id}} input-border last" min="0" max="100" value="0" name="q{{$element[2]->id}}" id="{{$element[2]->id}}" style="width:50px" type="number" >
            % auf Kleintransporter und Transporter bis 3,5 Tonnen, 
            <input class="form-input q{{$element[0]->id}} input-border last" min="0" max="100" value="0" name="q{{$element[3]->id}}" id="{{$element[3]->id}}" style="width:50px" type="number" >
            % Sonstige           
        </div>
        <i id="last" class="error" style="color:#f00; font-size:12px; "></i>

    </div>
        
</div>
