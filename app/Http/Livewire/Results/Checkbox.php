<?php

namespace App\Http\Livewire\Results;

use Livewire\Component;

class Checkbox extends Component
{
    public $results, $element, $devide, $result;

    public function render()
    {
        if($this->element[0]->type == 'checkbox'){
            $this->checkboxResult();
        } else {
            $this->radioResult();
        }
        return view('livewire.results.checkbox');
    }

    public function checkboxResult()
    {
        $combined = '';
        //dd($this->results, $this->element);
        if(array_key_exists('q'.$this->element[0]->id, $this->results)) {
            // $devide -> count of people answered this question
            $this->devide = count($this->results['q'.$this->element[0]->id]);
            //dd($this->results['q'.$this->element[0]->id]);
            foreach ($this->results['q'.$this->element[0]->id] as $res) {
                $combined = $combined . ',' . $res;
            }
        }
        $combined = substr($combined, 1);
        $combined = str_replace(array( '[', ']', ' ' ), '', $combined);
        $combined = explode(',', $combined);
        $combined = array_count_values($combined);
        //dd($combined);

        $this->result = $combined;      
    }

    public function radioResult()
    {
        //dd($this->results, $this->element);
        if(array_key_exists('q'.$this->element[0]->id, $this->results)) {
            // $devide -> count of people answered this question
            $this->devide = count($this->results['q'.$this->element[0]->id]);      
            $this->result = array_count_values($this->results['q'.$this->element[0]->id]);      
        } else {
            $this->result = [];      
        }

        
        //dd($this->result);   
    }
}
