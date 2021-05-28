<div>
    <div class="card shadow  connectedSortable1" >
        <div class="card-header">
            <div class="row">
                <div class="col-1">{{$element->position}} {{$element->id}} </div>
                <div class="col-6  @if($element->trashed()) disabled @endif">@livewire('element-text', ['element_id'=>$element->id, 'text'=>$element->text, 'type'=>$element->type], key($element->id))</div>
                <div class="col-3  @if($element->trashed()) disabled @endif">
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$element->type}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($types as $type)
                                <a type="button" class="dropdown-item" wire:click="$emit('changeType', {{$element->id}}, '{{$type}}')" >{{$type}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus fa-2x"></i>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
        @if($element->type == "radio" || $element->type == 'checkbox' || $element->type == 'linear_scale')
        <div class="card-body @if($element->trashed()) disabled @endif">
            @if($element->type == 'linear_scale')
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownOpt2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           1 to {{$scale ?? 5 }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownOpt2">
                            @for($i=2; $i<=10; $i++)
                                <a type="button" class="dropdown-item" wire:click="$emit('updateOpt', {{$element->id}}, {{$i}})" >1 to {{$i}}</a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <ul id="sortable" class="list-unstyled mx-2">
                @foreach($elements as $key => $elem) 
                    <li id="sub_{{$elem->id}}" alt="{{$element->id}}">
                        <div class="row shadow my-3">
                            <div class="col-1">
                                <div class="row">
                                    <a type="button" wire:click="position({{$elem->position}},{{$elem->position-1}})" title="Move up"><img width="20px" src="{{ asset('vendor/adminlte/dist/img/arrow.png') }}"></a>
                                </div>
                                <div class="row">
                                    <a type="button" style="line-height: 9px;transform: rotate(180deg);"  wire:click="position({{$elem->position}},{{$elem->position+1}})" title="Move down"><img width="20px" src="{{ asset('vendor/adminlte/dist/img/arrow.png') }}"></a>
                                </div> 
                                {{$elem->id}} 
                                @if($element->type == 'radio')  
                                    <i class="position-absolute far fa-circle" style="top: 35%; left: 60%;"></i>
                                @elseif($element->type == 'checkbox')  
                                    <i class="position-absolute far fa-square" style="top: 35%; left: 60%;"></i>
                                @endif
                            </div>
                            <div class="col-8 pt-1" @if ($elem->trashed())  style="pointer-events: none; opacity: 0.5; background: #CCC;"  @endif >                                                              
                                @if($elem->type == 'short_text' || $elem->type == 'long_text')
                                    Other...
                                @else                            
                                    @livewire('element-text', ['element_id'=>$elem->id, 'text'=>$elem->text, 'type'=>$elem->type], key($elem->id))
                                @endif
                            </div>
                            <div class="col-3">
                                <div class="row w-100">
                                    <div class="col-10">
                                        <div>
                                            <i type="button" onclick="$( '#h{{$elem->id}}' ).toggle()" title="Invisible" class="fas fa-eye-slash"></i>
                                            <input id="h{{$elem->id}}" class="hide w-75" alt="{{$elem->id}}" type="text" name="hide" placeholder="hide" style="display:none;" value="{{$opt[$elem->id]['hide'] ?? ''}}">
                                        </div>
                                        <div>
                                            <i type="button" onclick="$( '#s{{$elem->id}}' ).toggle()" title="Visible" class="fas fa-eye"></i>
                                            <input id="s{{$elem->id}}" class="hide w-75" alt="{{$elem->id}}" type="text" name="show" placeholder="show" style="display:none;" value="{{$opt[$elem->id]['show'] ?? ''}}">
                                        </div>
                                        
                                    </div>
                                    @if ($elem->trashed())  
                                    <div class="col-1 position-relative"><i wire:click="delete({{$elem->id}}, 'restore')" title="restore" class="position-absolute fas fa-trash-restore"></i></div>
                                    <div class="col-1 position-relative"><i wire:click="delete({{$elem->id}}, 'destroy')" title="delete" class="position-absolute fas fa-trash"></i></div>
                                    @else
                                    <div class="col-2 position-relative text-right"><i wire:click="delete({{$elem->id}}, 'soft')" title="disable" class="position-absolute fas fa-times"></i></div>
                                    @endif                                    
                                    
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
                <li>
                    <div class="row">
                        <div class="col-sm-12">
                            <span type="button" class="text-primary" wire:click="addOption({{$element->survey_id}},{{$element->id}}, {{$key+2}})" title="Add option"><i class="far fa-plus-square"></i> New option</span>
                            &nbsp;&nbsp;&nbsp; or &nbsp;&nbsp;&nbsp;
                            <a type="button" class="text-primary" wire:click="addOption({{$element->survey_id}},{{$element->id}}, {{$key+2}}, 'short_text')" title="Free text" >Other...</a>
                        </div>
                    </div>
                    
                    
                </li>
                
            </ul>
        </div>
        @elseif($element->type == "multy_radio" || $element->type == 'multy_checkbox')
        <div class="card-body @if($element->trashed()) disabled @endif">
            <div class="row">
                <div class="col-sm-6">Rows</div>
                <div class="col-sm-6">Cols</div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <ul id="sortable2" class="list-unstyled mx-2">
                        @foreach($elements as $key => $elem)
                            @if($elem->type != 'col')
                            <li id="sub_{{$elem->id}}" alt="{{$element->id}}">
                                <div class="row shadow my-3">
                                    <div class="col-1">
                                        <div class="row">
                                            <a type="button" wire:click="position({{$elem->position}},{{$elem->position-1}})" title="Move up"><img width="20px" src="{{ asset('vendor/adminlte/dist/img/arrow.png') }}"></a>
                                        </div>
                                        <div class="row">
                                            <a type="button" style="line-height: 9px;transform: rotate(180deg);"  wire:click="position({{$elem->position}},{{$elem->position+1}})" title="Move down"><img width="20px" src="{{ asset('vendor/adminlte/dist/img/arrow.png') }}"></a>
                                        </div> 
                                        
                                        @if($element->type == 'multy_radio')  
                                            <i class="position-absolute far fa-circle" style="top: 35%; left: 60%;"></i>
                                        @elseif($element->type == 'multy_checkbox')  
                                            <i class="position-absolute far fa-square" style="top: 35%; left: 60%;"></i>
                                        @endif                                         
                                    </div>
                                    <div class="col-8 pt-1" @if ($elem->trashed())  style="pointer-events: none; opacity: 0.5; background: #CCC;"  @endif >                                                              
                                        @if($elem->type == 'short_text' || $elem->type == 'long_text')
                                            Other...
                                        @else                            
                                            @livewire('element-text', ['element_id'=>$elem->id, 'text'=>$elem->text, 'type'=>$elem->type], key($elem->id))
                                        @endif
                                    </div>
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-6">{{$elem->id}}/{{$elem->position}}</div>
                                            @if ($elem->trashed())  
                                            <div class="col-3 position-relative"><i wire:click="delete({{$elem->id}}, 'restore')" title="restore" class="position-absolute fas fa-trash-restore"></i></div>
                                            <div class="col-3 position-relative"><i wire:click="delete({{$elem->id}}, 'destroy')" title="delete" class="position-absolute fas fa-trash"></i></div>
                                            @else
                                            <div class="col-3 position-relative"><i wire:click="delete({{$elem->id}}, 'soft')" title="disable" class="position-absolute fas fa-times"></i></div>
                                            @endif                                    
                                            
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @endforeach
                        <li>
                            <div class="row">
                                <div class="col-sm-12">
                                    <span type="button" class="text-primary" wire:click="addOption({{$element->survey_id}},{{$element->id}}, {{$key+2}})" title="Add option"><i class="far fa-plus-square"></i> New option</span>
                                    &nbsp;&nbsp;&nbsp; or &nbsp;&nbsp;&nbsp;
                                    <a type="button" class="text-primary" wire:click="addOption({{$element->survey_id}},{{$element->id}}, {{$key+2}}, 'short_text')" title="Free text" >Other...</a>
                                </div>
                            </div>
                            
                            
                        </li>
                        
                    </ul>
                </div>
                <div class="col-sm-6">
                <ul id="sortable2" class="list-unstyled mx-2">
                        @foreach($elements as $key => $elem)
                            @if($elem->type == 'col')
                            <li id="sub_{{$elem->id}}" alt="{{$element->id}}">
                                <div class="row shadow my-3">
                                    <div class="col-1">
                                        <div class="row">
                                            <a type="button" wire:click="position({{$elem->position}},{{$elem->position-1}})" title="Move up"><img width="20px" src="{{ asset('vendor/adminlte/dist/img/arrow.png') }}"></a>
                                        </div>
                                        <div class="row">
                                            <a type="button" style="line-height: 9px;transform: rotate(180deg);"  wire:click="position({{$elem->position}},{{$elem->position+1}})" title="Move down"><img width="20px" src="{{ asset('vendor/adminlte/dist/img/arrow.png') }}"></a>
                                        </div>  
                                        @if($element->type == 'multy_radio')  
                                            <i class="position-absolute far fa-circle" style="top: 35%; left: 60%;"></i>
                                        @elseif($element->type == 'multy_checkbox')  
                                            <i class="position-absolute far fa-square" style="top: 35%; left: 60%;"></i>
                                        @endif
                                    </div>
                                    <div class="col-7 pt-1" @if ($elem->trashed())  style="pointer-events: none; opacity: 0.5; background: #CCC;"  @endif >                                                              
                                        @if($elem->type == 'short_text' || $elem->type == 'long_text')
                                            Other...
                                        @else                            
                                            @livewire('element-text', ['element_id'=>$elem->id, 'text'=>$elem->text, 'type'=>'col'], key($elem->id))
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        <div class="row">
                                            <div class="col-6">{{$elem->id}}/{{$elem->position}} 
                                                <div>
                                                    <i type="button" onclick="$( '#h{{$elem->id}}' ).toggle()" title="Invisible" class="fas fa-eye-slash"></i>
                                                    <input id="h{{$elem->id}}" class="hide w-75" alt="{{$elem->id}}" type="text" name="hide" placeholder="hide" style="display:none;" value="{{$opt[$elem->id]['hide'] ?? ''}}">
                                                </div>
                                                <div>
                                                    <i type="button" onclick="$( '#s{{$elem->id}}' ).toggle()" title="Visible" class="fas fa-eye"></i>
                                                    <input id="s{{$elem->id}}" class="hide w-75" alt="{{$elem->id}}" type="text" name="show" placeholder="show" style="display:none;" value="{{$opt[$elem->id]['show'] ?? ''}}">
                                                </div>
                                            </div>
                                            @if ($elem->trashed())  
                                            <div class="col-3 position-relative"><i wire:click="delete({{$elem->id}}, 'restore')" title="restore" class="position-absolute fas fa-trash-restore"></i></div>
                                            <div class="col-3 position-relative"><i wire:click="delete({{$elem->id}}, 'destroy')" title="delete" class="position-absolute fas fa-trash"></i></div>
                                            @else
                                            <div class="col-3 position-relative"><i wire:click="delete({{$elem->id}}, 'soft')" title="disable" class="position-absolute fas fa-times"></i></div>
                                            @endif                                    
                                            
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @endforeach
                        <li>
                            <div class="row">
                                <div class="col-sm-12">
                                    <span type="button" class="text-primary" wire:click="addOption({{$element->survey_id}},{{$element->id}}, {{$key+2}}, 'col')" title="Add option"><i class="far fa-plus-square"></i> New option</span>                                    
                                </div>
                            </div>
                            
                            
                        </li>
                        
                    </ul>
                </div>
            </div>
            
            
        </div>
        @elseif($element->type == "short_text" || $element->type == "long_text")
        <div class="card-body @if($element->trashed()) disabled @endif">
            <input class="w-100" type="text" placeholder="{{$element->type}}" >
        </div>
        @endif
        <div class="card-footer text-muted text-right">
            <a class="align-top pt-1" type="button" wire:click="$emit('position', {{$element->id}}, {{$element->position-1}})" title="Move up"><img width="35px" src="{{ asset('vendor/adminlte/dist/img/arrow.png') }}"></a>
            <a class="align-top mt-1" type="button" style="transform: rotate(180deg);" wire:click="$emit('position', {{$element->id}}, {{$element->position+1}})" title="Move down"><img width="35px" src="{{ asset('vendor/adminlte/dist/img/arrow.png') }}"></a>
            @if($element->required == 0)
                <i type="button" wire:click="required({{$element->id}}, 1)" title="Required" class="mx-3 fas fa-toggle-off fa-2x"></i>
            @else
                <i type="button" wire:click="required({{$element->id}}, 0)" title="Required" class="mx-3 text-success fas fa-toggle-on fa-2x"></i>
            @endif

            @if($element->visible == 0)
                <i type="button" wire:click="visible({{$element->id}}, 1)" title="Invisible" class="mx-3 fas fa-eye-slash fa-2x"></i>
            @else
                <i type="button" wire:click="visible({{$element->id}}, 0)" title="Visible" class="mx-3 text-success fas fa-eye fa-2x"></i>
            @endif

            
            @if($element->trashed())  
            <i type="button" onclick="action({{$element->id}})" wire:click="$emit('delete', {{$element->id}}, 'restore')" title="restore" class="mx-3 fas fa-trash-restore fa-2x"></i>
            <i type="button" wire:click="$emit('delete', {{$element->id}}, 'destroy')" title="delete" class="mx-3 fas fa-trash fa-2x"></i>
            @else
                <i type="button" wire:click="$emit('delete', {{$element->id}}, 'soft')" title="disable" class="mx-3 fas fa-times fa-2x"></i>
            @endif  
            <i class="fas fa-grip-horizontal fa-2x position-absolute" style="right: 48%;"></i>
        </div>
    </div>
</div>