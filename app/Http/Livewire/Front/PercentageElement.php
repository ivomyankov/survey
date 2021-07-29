<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class PercentageElement extends Component
{
    public $element; 
    
    public function render()
    {
        return view('livewire.front.percentage-element');
    }
}
