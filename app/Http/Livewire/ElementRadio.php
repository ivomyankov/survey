<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Element;

class ElementRadio extends Component
{
    public $element, $types, $elements, $key=-1, $opt=[1,5];

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public function mount()
    {
        
    }

    public function render()
    {    
        $this->elements = Element::withTrashed()
                                ->where('parent_id', $this->element->id)
                                ->orderBy('position', 'ASC')
                                ->get();
        $this->types = $this->types(); 
        return view('livewire.element-radio');
    }

    public function addOption($survey_id, $parent_id, $position, $type = NULL)
    { //dd($survey_id, $parent_id, $position, $type);
        Element::create([
            'survey_id' => $survey_id,
            'type'      => $type,
            'text'      => NULL,
            'parent_id' => $parent_id,
            'position'  => $position
        ]);
    }

    public function required($id, $state)
    {
        Element::Find($id)
                ->update(['required' => $state]);

        $this->element->required = $state;
    }

    public function delete($id, $action)
    {
        if($action == 'soft'){
            Element::Find($id)->delete();
        } else if($action == 'restore'){ 
            Element::withTrashed()
                ->where('id', $id)
                ->restore();
        } else if($action == 'destroy'){
            Element::withTrashed()
                ->where('id', $id)
                ->forceDelete();
        }
        
    }

    public function position($cur_pos, $new_pos)
    {
        if($new_pos <= $this->elements->count() && $new_pos > 0){
            //dd($id, $cur_pos, $new_pos, $this->elements->count(), $this->elements);
            foreach($this->elements as $element){
                if($element->position == $new_pos){
                    Element::withTrashed()
                        ->where('id', $element->id)
                        ->update(['position' => $cur_pos]);
                } else if($element->position == $cur_pos){
                    Element::withTrashed()
                        ->where('id', $element->id)
                        ->update(['position' => $new_pos]);
                }
            } 
            //->update(['text' => $propertyText]);
        }        
    }


    public function types()
    {
        return Element::types();
    }
}
