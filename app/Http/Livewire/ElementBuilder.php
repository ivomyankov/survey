<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Element;

class ElementBuilder extends Component
{
    public $element, $options; 

    public function render()
    {
        return view('livewire.element-builder');
    }
}
