<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Element;

class ElementImage extends Component
{
    public $element_id, $element, $text, $type, $opt, $style; 

    public function mount()
    { 
        //dd($this->element);
        $this->style = $this->element->style;
    }

    public function render()
    {
        return view('livewire.element-image');
    }

    public function updatedText()
    {       
        Element::where('id', $this->element_id)
            ->update(['text' => $this->text]);
    }

    public function updatedStyle()
    {               
        Element::where('id', $this->element_id)
            ->update(['style' => $this->style]);
    }

    public function visible($id, $state)
    {
        Element::Find($id)
                ->update(['visible' => $state]);

        $this->element->visible = $state;
    }

}
