<div>
    <div class="card shadow">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-1">{{$element->position}}</div>
                <div class="col-sm-8">@livewire('element-text', ['element_id'=>$element->id, 'text'=>$element->text, 'type'=>$element->type], key($element->id))</div>
                <div class="col-sm-3">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$element->type}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($types as $type)
                                <a type="button" class="dropdown-item" wire:click="$emit('changeType', {{$element->id}}, '{{$type}}')" >{{$type}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        @if($element->type == "short_text" || $element->type == "long_text")
        <div class="card-body">
            <input type="text" placeholder="{{$element->type}}" size="100" disabled>
        </div>
        @elseif($element->type == "linear_scale")
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-1 text-center">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownOpt1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            0
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownOpt1">
                            <a type="button" class="dropdown-item" wire:click="$emit('changeType', {{$element->id}}, '{{$type}}')" >0</a>
                            <a type="button" class="dropdown-item" wire:click="$emit('changeType', {{$element->id}}, '{{$type}}')" >1</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 text-center">to</div>
                <div class="col-sm-1 text-center">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownOpt2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            2
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownOpt2">
                            @for($i=2; $i<=10; $i++)
                                <a type="button" class="dropdown-item" wire:click="$emit('changeType', {{$element->id}}, '{{$type}}')" >{{$i}}</a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <ul class="list-unstyled mx-2">
                    @foreach( $opt as $index => $op )
                    <li>
                        <i class="far fa-circle" ></i> 
                        <input type="text" id="{{$index}}" 
                            class="p-1 px-0 w-75 focus:shadow-outline focus:outline-none" 
                            placeholder="text here" autocomplete="off" wire:model.lazy="text"
                            style="background: no-repeat; border: none; color: #797979;">
                    </li>
                    @endforeach
                <li>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="text-primary" wire:click="addOpt()" title="Add option"><i class="far fa-plus-square"></i> New option</span>                            
                        </div>
                    </div>
                    
                    
                </li>
                
            </ul>
        </div>
        @endif
        <div class="card-footer text-muted text-right">
            {{$element->required}} 
        </div>
    </div>
</div>