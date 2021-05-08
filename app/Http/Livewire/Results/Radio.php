<?php

namespace App\Http\Livewire\Results;

use Livewire\Component;

class Radio extends Component
{
    public $results, $element, $devide, $result;

    public function render()
    {
        $this->result();
        return view('livewire.results.radio');
    }

    public function result()
    {
        //dd($this->results, $this->element);
        if(array_key_exists('q'.$this->element[0]->id, $this->results)) {
            // $devide -> count of people answered this question
            $this->devide = count($this->results['q'.$this->element[0]->id]);            
        }
        $this->result = array_count_values($this->results['q'.$this->element[0]->id]);
        //dd($this->result);   
    }
}
