<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Element;

class ElementQuestions extends Component
{
    public $parents, $scale, $element, $types, $elements, $key=-1, $opt = []; 

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public function mount()
    {
        $this->elements = Element::withTrashed()
            ->where('parent_id', $this->element->id)
            ->orderBy('position', 'ASC')
            ->get();

        $this->scale();
        $this->getElements();
        $this->types = $this->types(); 
        $this->opt(); 
    }

    public function hydrate()
    {
        $this->scale();
    }

    public function render()
    {    
         
        return view('livewire.element-questions');
    }

    public function getElements()
    {
        $this->elements = Element::withTrashed()
            ->where('parent_id', $this->element->id)
            ->orderBy('position', 'ASC')
            ->get();
    }

    public function scale()
    {   
        //dd($this->element['type']);
        if ($this->element['type'] == 'linear_scale' && !is_null($this->element['opt']) ) {                
            $scale = json_decode($this->element['opt'], true);
            if (array_key_exists('linear', $scale)) {
                $this->scale = $scale['linear'];
            }
        }
        
        
        //dd($this->scale);
    }

    public function addOption($survey_id, $parent_id, $position, $type = NULL)
    { //dd($survey_id, $parent_id, $position, $type);
        $new_element = Element::create([
            'survey_id' => $survey_id,
            'type'      => $type,
            'text'      => NULL,
            'parent_id' => $parent_id,
            'position'  => $position
        ]);
        $this->elements->push($new_element);
    }

    public function required($id, $state)
    {
        Element::Find($id)
                ->update(['required' => $state]);

        $this->element->required = $state;
    }

    public function visible($id, $state)
    {
        Element::Find($id)
                ->update(['visible' => $state]);

        $this->element->visible = $state;
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
        $this->getElements();
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

    public function opt()
    {
        foreach ($this->elements as $element) {
            if(isset($element->opt)){
                $decode = json_decode($element->opt, true);
                if(isset($decode['go_to']['show'])){
                    $this->opt[$element->id]['show'] = $decode['go_to']['show'];
                }
                if(isset($decode['go_to']['hide'])){
                    $this->opt[$element->id]['hide'] = $decode['go_to']['hide'];
                }
            }
        }
    }
}
