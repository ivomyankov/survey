<?php

namespace App\Http\Livewire\Results;

use Livewire\Component;

class PercentageElement extends Component
{
    public $results, $element, $options = [];

    public function mount()
    {
        $this->element = array_values($this->element);
        $this->options();
    }

    public function render()
    {
        return view('livewire.results.percentage-element');
    }

    private function options()
    {
        
        foreach ($this->element as $key => $elem) {
            if ( $key > 0 && array_key_exists('q'.$elem->id, $this->results ) ) {
                $this->options[$key] = round(array_sum($this->results['q'.$elem->id])/count($this->results['q'.$elem->id]), 1);
            }
        }

        return;
    }
}
