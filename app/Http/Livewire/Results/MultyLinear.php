<?php

namespace App\Http\Livewire\Results;

use Livewire\Component;

class MultyLinear extends Component
{
    public $results, $scale, $element, $devide, $result, $scaleSide; 

    public function render()
    { //dd($this->element, $this->results);
        $this->scaleSide();
        $this->result();
        return view('livewire.results.multy-linear');
    }

    public function scaleSide()
    {   
        $scale = json_decode($this->element[0]->opt, true);
        $this->scale = $scale['linear'];
        //dd($this->scale);
            
        // intdiv - whole number deviding 5/2=2
        $this->scaleSide = intdiv((12 - $this->scale), 2);
    }

    public function result()
    {
        //dd($this->element[0]->id, $this->results, $this->element); 
        // reset element keys
        $this->element = array_values($this->element);   
        foreach($this->element as $key => $value){
            if($key>0){
                if(array_key_exists('q'.$this->element[$key]->id, $this->results)) {
                    // $devide -> count of people answered this question
                    $this->devide = count($this->results['q'.$this->element[$key]->id]); 
                    $this->result[$key] = array_count_values($this->results['q'.$this->element[$key]->id]);           
                }
            }
        }
         
        //dd($this->devide, $this->result);   
    }
}
