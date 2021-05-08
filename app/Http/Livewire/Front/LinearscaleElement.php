<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class LinearscaleElement extends Component
{
    public $element, $scaleSide, $bothOptions=[]; 

    
    public function render()
    {
        $this->scaleSide();
        $this->bothOptions();
        return view('livewire.front.linearscale-element');
    }

    public function scaleSide()
    {
        // intdiv - whole number deviding 5/2=2
        $this->scaleSide = intdiv((12 - $this->element[0]->options), 2);
    }

    public function bothOptions()
    {
        $i=-1;
        foreach($this->element as $key => $value){
            $i++;
            if($i==1 || $i==2){
                array_push($this->bothOptions, $this->element[$key]);
            }
        }
        //dd($this->bothOptions);
    }
}
