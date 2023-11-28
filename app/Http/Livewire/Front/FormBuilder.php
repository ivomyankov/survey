<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Element;

class FormBuilder extends Component
{
    public $element, $options; 

    public function render()
    {
        //$this->split();
        return view('livewire.front.form-builder');
    }

    public function split()
    {
        if(in_array($this->element[0]->type, ['h1','h2', 'b', 'p']) && str_contains($this->element[0]->text, '|')){
            foreach(explode('|', $this->element[0]->text) as $key => $row){
                echo $key > 0 ? '<br>' : '';
                echo $row;
            }
                        
        }
    }

}
