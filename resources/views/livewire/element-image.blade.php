<div>
    <div class="card shadow  connectedSortable1" >
        <div class="card-header">
            <div class="row">            
                <div class="col-6  @if($element->trashed()) disabled @endif">
                    URL: <input type="text" 
                        class="{{$element_id}} {{$type}} py-1 px-0 w-100 focus:shadow-outline focus:outline-none" 
                        placeholder="text here" autocomplete="off" wire:model.lazy="text"
                        style="background: no-repeat; border: none; color: #797979;">
                </div>
                <div class="col-6 text-right">
                    <div class="card-tools">                        
                        #{{$element->id}}   &nbsp; 
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus fa-2x"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <a class="align-top pt-1 d-sm-none" type="button" wire:click="$emit('position', {{$element->id}}, {{$element->position-1}})" title="Move up"><img width="35px" src="{{ asset('vendor/adminlte/dist/img/arrow.png') }}"></a>
                    <a class="align-top mt-1 d-sm-none" type="button" style="transform: rotate(180deg);" wire:click="$emit('position', {{$element->id}}, {{$element->position+1}})" title="Move down"><img width="35px" src="{{ asset('vendor/adminlte/dist/img/arrow.png') }}"></a>
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
                </div>
            </div>
            <div class="row">{{--dd($elements,$element)--}}
                <div class="col-6" style="text-align:{{ $element->align }};">
                    <img src="{{$text}}" style="margin-right: 50px;height: 100px;margin-top: 5px;">                    
                </div>
                <div class="col-6">
                    Style:
                    <input type="text" id="style"
                                class="{{$element_id}} {{$type}} py-1 px-0 w-100 focus:shadow-outline focus:outline-none" 
                                autocomplete="on" wire:model.lazy="style" 
                                style="background: no-repeat; border: none; color: #797979;">
                </div>
            </div>
        </div>
    </div>
</div>