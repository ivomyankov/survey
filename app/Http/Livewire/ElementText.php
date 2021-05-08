<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Element;

class ElementText extends Component
{
    public $element_id, $text, $type;


    public function render()
    {
        $this->textTypeFix();
        return view('livewire.element-text');
    }

    public function textTypeFix()
    {
        if($this->type == 'i'){
            $this->type = 'font-italic';
        } else if($this->type == 'b'){
            $this->type = 'font-weight-bold';
        }
        return;
    }

    public function updatedText()
    {        
        Element::where('id', $this->element_id)
            ->update(['text' => $this->text]);
 
     }
}
