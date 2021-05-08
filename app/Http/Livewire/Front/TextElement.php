<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class TextElement extends Component
{
    public $element, $rows; 

    public function render()
    {
        $this->rows();
        return view('livewire.front.text-element', ['rows'=>$this->rows]);
    }

    public function rows()
    {
        if($this->element[0]->type == 'long_text'){
            $this->rows = 5;
        } else {
            $this->rows = 1;
        }
    }
}
