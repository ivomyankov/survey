<?php

namespace App\Http\Livewire\Results;

use Livewire\Component;

class Text extends Component
{
    public $results, $element, $result; 

    public function render()
    {
        //dd($this->results, $this->element);
        //$this->result();
        return view('livewire.results.text');
    }


    public function result()
    {
        if(isset($this->element['q'.$this->element[0]->id.'_t']))
        foreach($this->element as $key => $value){
            $i++;
            if($i==1 || $i==2){
                array_push($this->bothOptions, $this->element[$key]);
            }
        }
        //dd($this->bothOptions);
    }

}
