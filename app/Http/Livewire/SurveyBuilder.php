<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Element;

class SurveyBuilder extends Component
{
    public $elements, $survey, $text, $key, $nextPosition=1;
    public $elem_ar = [];
    //public Heading $heading;

    protected $listeners = [
        'changeType' => 'changeType',
        'updateOpt' => 'updateOpt',
        'position' => 'position',
        'delete' => 'delete'
    ];
   

    public function render()
    { 
        $this->elements = $this->data($this->survey);
        return view('livewire.survey-builder');
    }

    public function data($survey)
    {
        $elements = Element::withTrashed()
                        ->where("survey_id", $survey)
                        ->where(function ($query) {
                            $query->where('parent_id', 0)
                                ->orWhere('parent_id', NULL);
                        })
                        ->orderBy('position', 'ASC')
                        ->get();
                      
        $this->nextPosition = $elements->count()+1;
        return $elements;
    }

    public function addQuestion($parent = 0) 
    {   
        //$this->validate();
        // Execution doesn't reach here if validation fails.
        Element::create([
            'survey_id' => $this->survey,
            'text'      => NULL,
            'parent_id' => $parent,
            'position'  => $this->nextPosition
        ]);
    }

    public function addHeading($parent = 0) 
    {   
        Element::create([
            'survey_id' => $this->survey,
            'type'      => 'h1',
            'text'      => 'heading',
            'parent_id' => $parent,
            'position'  => $this->nextPosition
        ]);
    }

    public function addBold($parent = 0) 
    {   
        Element::create([
            'survey_id' => $this->survey,
            'type'      => 'b',
            'text'      => 'bold',
            'parent_id' => $parent,
            'position'  => $this->nextPosition
        ]);
    }

    public function addItalic($parent = 0) 
    {   
        Element::create([
            'survey_id' => $this->survey,
            'type'      => 'i',
            'text'      => 'italic',
            'parent_id' => $parent,
            'position'  => $this->nextPosition
        ]);
    }

    public function addParagraph($parent = 0) 
    {   
        Element::create([
            'survey_id' => $this->survey,
            'type'      => 'p',
            'text'      => 'paragraph',
            'parent_id' => $parent,
            'position'  => $this->nextPosition
        ]);
    }

    public function addSeparator($parent = 0) 
    {   
        Element::create([
            'survey_id' => $this->survey,
            'type'      => 'hr',
            'parent_id' => $parent,
            'position'  => $this->nextPosition
        ]);
    }

    public function updatedText($propertyText, $propertyKey)
    {        dd($propertyText, $propertyKey);
        $this->validateOnly($propertyText);
        Element::where('id', $propertyKey)
            ->update(['text' => $propertyText]);
 
    }
/*
    public function changeType($id, $type)
    {       
        $toUpdate = [];

        if ($type == 'final_question'){
            $toUpdate = [
                    'type' => $type,
                    'text' => 'Davon entfallen'
                ]; 
        } else {
            $toUpdate = ['type' => $type]; 
        }
        Element::where('id', $id)
                ->update($toUpdate); 

        $this->emit('refresh');
    }
*/
    public function changeType($id, $type)
    {       
        if ($type == 'final_question'){
            $this->finalQuestion($id, $type);
        } else {
            Element::where('id', $id)
                ->update(['type' => $type]);
        }

        $this->emit('refresh');
    }

    public function finalQuestion($id, $type)
    {
        Element::where('id', $id)
                ->update([
                    'type' => $type,
                    'text' => 'Davon entfallen'
                ]);

        $child = Element::where('parent_id', $id)
                ->get();
        
        if ( $child->isEmpty()){
            $final = Element::find($id);

            Element::insert([
                [
                    'survey_id' => $final->survey_id,
                    'parent_id' => $id,
                    'type'      => NULL,
                    'position'  => 1
                ],
                [
                    'survey_id' => $final->survey_id,
                    'parent_id' => $id,
                    'type'      => NULL,
                    'position'  => 2
                ],
                [
                    'survey_id' => $final->survey_id,
                    'parent_id' => $id,
                    'type'      => NULL,
                    'position'  => 3
                ]
            ]);
        } 
        
        return;
    }

    public function updateOpt($id, $i)
    { 
        Element::where('id', $id)
            ->update(['opt' => '{"linear":'.$i.'}']);

        $this->emit('refresh');
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
        $this->emit('refresh');
    }

    public function position($id, $new_pos)
    {dd($this->survey, $id, $new_pos, $this->elements->count(), $this->elements);
        if($new_pos <= $this->elements->count() && $new_pos > 0){
            dd($this->survey, $id, $new_pos, $this->elements->count(), $this->elements);
            foreach($this->elements as $element){
                if($element->position == $new_pos){
                    Element::withTrashed()
                        ->where('id', $element->id)
                        ->update(['position' => $id]);
                } else if($element->position == $id){
                    Element::withTrashed()
                        ->where('id', $element->id)
                        ->update(['position' => $new_pos]);
                }
            } 
            //->update(['text' => $propertyText]);
        }        
    }

    // validation
    public function validateSurvey()
    {
        return request()->validate([
            'name' => 'min:3|max:50'
        ]);
    }

    
}
