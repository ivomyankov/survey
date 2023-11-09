<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class ImageElement extends Component
{
    public $element; 

    public function render()
    {
        return view('livewire.front.image-element');
    }
}
