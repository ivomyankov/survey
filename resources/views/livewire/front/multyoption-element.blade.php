<div class="rounded shadow bg-light p-4 position-relative {{ $element[0]->visible === 0 ? 'hidden' : '' }} mt-5" id="{{$element[0]->id}}" >
    @if($element[0]->required == 1)
        <i class="text-danger position-absolute trquired" style="top:5px; right:10px;">required</i>
    @endif
    

    @foreach($element as $key => $option)
        @if($key==0)
            <b>{{$element[0]->text}}</b>
            @if($element[0]->type == 'checkbox')
                <i>(Mehrfachnennungen möglich)</i>
            @endif
        @endif
    @endforeach
            <div class="row pt-1">
                <div class="col-sm-{{12-count($rows)*2}}"> </div>
                @foreach($rows as $key => $row)
                    <div class="col-sm-2 text-center" alt="{{$row->id}}">{{$row->text}}</div>
                @endforeach

                
            </div>
            @foreach($element as $key => $option)
                @if($key > 0 && $option->type != 'col')
                    <div class="row">
                        <div class="col-sm-{{12-count($rows)*2}}" alt="{{$option->id}} "> 
                            <span class="mark" id="q{{$option->id}}">*</span>                           
                            {{$option->text}}
                            @if($option->type == 'short_text')
                                <input class="w-100 input-border" type="text" name="q{{$option->id}}_s" id="q{{$option->id}}_s" placeholder="Sonstiges:">
                            @endif
                        </div>
                        @for($i=1; $i<=count($rows); $i++)
                        <div class="col-sm-2 text-center"><input class="form-check-input q{{$element[0]->id}}" type="{{$element[0]->type}}" value="{{$rows[$i-1]->id}}" name="q{{$option->id}}[]" id="q{{$option->id}}_{{$rows[$i-1]->id}}"></div>
                        @endfor
                    </div>
                @endif
            @endforeach
            
</div>