<?php

namespace App\Http\Livewire\Results;

use Livewire\Component;

class Linear extends Component
{
    public $results, $scale, $element, $devide, $result, $scaleSide, $bothOptions=[]; 

    public function render()
    {
        $this->scaleSide();
        $this->bothOptions();
        $this->result();
        return view('livewire.results.linear');
    }

    public function scaleSide()
    {   
        $scale = json_decode($this->element[0]->opt, true);
        $this->scale = $scale['linear'];
        //dd($this->scale);
            
        // intdiv - whole number deviding 5/2=2
        $this->scaleSide = intdiv((12 - $this->scale), 2);
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

    public function result()
    {
        //dd($this->results, $this->element);
        if(array_key_exists('q'.$this->element[0]->id, $this->results)) {
            // $devide -> count of people answered this question
            $this->devide = count($this->results['q'.$this->element[0]->id]); 
            $this->result = array_count_values($this->results['q'.$this->element[0]->id]);           
        } 
        
        //dd($this->result);   
    }
}
