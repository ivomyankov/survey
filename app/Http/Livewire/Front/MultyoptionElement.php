<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class MultyoptionElement extends Component
{
    public $element, $rows=[];

    public function render()
    {
        $this->rows();
        $this->type();
        return view('livewire.front.multyoption-element');
    }

    public function rows()
    {
        foreach($this->element as $elem){
            if($elem->type == 'col'){
                array_push($this->rows, $elem);
                //$this->rows++;
            }
        }
        //dd($this->rows, count($this->rows));
    }

    public function type()
    {
        $this->element[0]->type = ltrim($this->element[0]->type, 'multy_');
    }
}
