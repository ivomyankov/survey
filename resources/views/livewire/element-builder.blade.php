<div class="row my-5">          
    <div class="col-sm-12"> {{--dd($element)--}}
        
            @if($element[0]->type == 'h1' || $element[0]->type == 'h2' || $element[0]->type == 'b' || $element[0]->type == 'p')
                <{{$element[0]->type}}>{{$element[0]->text}}</{{$element[0]->type}}>
            @elseif($element[0]->type == 'hr')
                <hr>
            @elseif($element[0]->type == 'radio' || $element[0]->type == 'checkbox')
                @livewire('front.option-element', ['element'=>$element])   
            @elseif($element[0]->type == 'multy_radio' || $element[0]->type == 'multy_checkbox')
                @livewire('front.multyoption-element', ['element'=>$element]) 
            @elseif($element[0]->type == 'linear_scale')
                @livewire('front.linearscale-element', ['element'=>$element])   
            @elseif($element[0]->type == 'short_text' || $element[0]->type == 'long_text')
                @livewire('front.text-element', ['element'=>$element])   
            @endif

        
    </div>
</div>