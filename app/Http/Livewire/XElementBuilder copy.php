<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Element;

class ElementBuilder extends Component
{
    public $element, $types, $text; 
    public $opt = [];

    public function mount()
    { /*
        if(isset($this->element->options)){
            dd($this->element->options->toArray());
            $options = $this->element->options->toArray();
            dd($this->element->options);
            $this->opt['text'] = $this->element->options['text'];
            
        }*/
    }

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public function render()
    {
        $this->types = $this->types(); 
        return view('livewire.element-builder');
    }

    public function addOpt()
    {
        array_push($this->opt,'test');
        //dd($this->opt);
    }

    public function updatedText()
    {        
        //array_push($this->opt['text'], $this->text);

        Element::where('id', $this->element->id)
            ->update(['options' => $this->opt]);
 
     }

    public function types()
    {
        return Element::types();
    }
}
