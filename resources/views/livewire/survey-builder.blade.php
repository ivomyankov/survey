<div>
    <div class="container">
        <div class="row">
            <div id="sortable" class="col-sm-11">
            {{--$elements--}} 
                @foreach($elements as $element)
                    <div id="sort_{{$element->id}}" class="position-relative" alt="0">
                        <i class="float-left fas fa-grip-vertical position-absolute text-secondary" style="left: -15px; top: 35%; cursor: all-scroll;" title="{{$element->position}}"></i>
                        @if($element->type == 'h1' || $element->type == 'h2' || $element->type == 'p' || $element->type == 'b' || $element->type == 'i' )
                            @livewire('element-text', ['element_id'=>$element->id, 'text'=>$element->text, 'type'=>$element->type], key($element->id))                    
                        @elseif($element->type == 'hr')
                            <hr>
                        @elseif($element->type == 'radio' || $element->type == 'checkbox' || $element->type == 'short_text' || $element->type == 'long_text' || $element->type == 'linear_scale' || $element->type == 'multy_radio' || $element->type == 'multy_checkbox' || $element->type == 'final_question')
                            @livewire('element-questions', ['element'=>$element, 'parents'=>$elements], key($element->id)) 
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="col-sm-1">
                <div class="w-100 bg-light shadow rounded" style="position: fixed; width: 6% !important;">
                    <ul id="survey-options-menu" >
                        <li><i wire:click="addQuestion" title="Add question" class="far fa-plus-square fa-2x"></i></li>
                        <li><i wire:click="addHeading" title="Add heading" class="fas fa-heading fa-2x"></i></li>
                        <li><i wire:click="addBold" title="Add bold text" class="fas fa-bold fa-2x"></i></li>
                        <li><i wire:click="addItalic" title="Add italic text" class="fas fa-italic fa-2x"></i></li>
                        <li><i wire:click="addParagraph" title="Add paragrap" class="fas fa-paragraph fa-2x"></i></li>
                        <li><i wire:click="addFinalQuestions" class="fas fa-grip-lines fa-2x"></i></li>
                        <li><i wire:click="addSeparator" title="Add separator" class="fas fa-minus fa-2x"></i></li>
                        <li><i class="fas fa-slash fa-2x"></i></li>
                        <li><i class="fas fa-image fa-2x"></i></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>