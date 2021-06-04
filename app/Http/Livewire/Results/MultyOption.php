<?php

namespace App\Http\Livewire\Results;

use Livewire\Component;

class MultyOption extends Component
{
    public $results, $element, $devide=[], $result=[], $cols=[], $v=0;
    public $colors = ['success', 'info', 'warning', 'danger', 'secondary'];

    public function render()
    {
        //dd($this->results, $this->element);
        if($this->element[0]->type == 'multy_checkbox'){
            $this->checkboxResult();
        } else {
            $this->radioResult();
        }
        return view('livewire.results.multy-option');
    }

    public function checkboxResult()
    {
        $i = -1;
        foreach ($this->element as $key => $option) {
            if($key > 0 && $option->type != 'col'){                 
                $this->result[$option->id] = implode(',', $this->results['q'.$option->id]);
                // removes [ ]
                $this->result[$option->id] = str_replace(array( '[', ']', ' ' ), '', $this->result[$option->id]);
                //  makes string to array 125, 216, 123
                $this->result[$option->id] = explode(',', $this->result[$option->id]);
                // counts the values in the array
                $this->result[$option->id] = array_count_values($this->result[$option->id]);
                // removes [] from the id. was [118]
                //$this->results['q'.$option->id] = preg_replace("/[^a-zA-Z 0-9]+/", "", $this->results['q'.$option->id] );
                // counts the answered options and adds to new array
                //$this->result[$option->id] = array_count_values($this->results['q'.$option->id]);
            } elseif($key > 0 && $option->type == 'col'){
                $i++;
                array_push($this->cols, [$option->id, $option->text, $this->colors[$i] ]);
            }

        }
        
//dd($this->results, $this->result, $this->cols);
  
    }

    public function radioResult()
    {
        $i = -1; dd($this->element);
        foreach ($this->element as $key => $option) {
            if($key > 0 && $option->type != 'col'){
                // removes [] from the id. was [118]
                $this->results['q'.$option->id] = preg_replace("/[^a-zA-Z 0-9]+/", "", $this->results['q'.$option->id] );
                // counts the answered options and adds to new array
                $this->result[$option->id] = array_count_values($this->results['q'.$option->id]);
            } elseif($key > 0 && $option->type == 'col'){
                $i++;
                array_push($this->cols, [$option->id, $option->text, $this->colors[$i] ]);
            }
        }      
        
        //dd($this->results, $this->result, $this->cols, $this->colors);   
    }
}
