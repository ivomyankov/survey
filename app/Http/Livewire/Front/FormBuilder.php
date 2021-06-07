<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Element;

class FormBuilder extends Component
{
    public $element, $options; 

    public function render()
    {
        return view('livewire.front.form-builder');
    }
}
