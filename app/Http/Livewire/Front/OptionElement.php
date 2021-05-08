<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class OptionElement extends Component
{
    public $element; 

    public function render()
    {
        return view('livewire.front.option-element');
    }
    
}
