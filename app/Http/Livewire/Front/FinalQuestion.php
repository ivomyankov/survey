<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class FinalQuestion extends Component
{
    public $element; 

    public function mount()
    {
        $this->element = array_values($this->element);
    }

    public function render()
    {
        return view('livewire.front.final-question');
    }
}
