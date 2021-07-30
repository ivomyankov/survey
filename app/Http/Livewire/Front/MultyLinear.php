<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class MultyLinear extends Component
{
    public $element, $scale, $scaleSide; 
    
    public function render()
    {
        $this->scaleSide();
        return view('livewire.front.multy-linear');
    }

    public function scaleSide()
    {   
        $scale = json_decode($this->element[0]->opt, true);
        $this->scale = $scale['linear'];
        //dd($this->scale);
            
        // intdiv - whole number deviding 5/2=2
        $this->scaleSide = intdiv((12 - $this->scale), 2);
    }
}
