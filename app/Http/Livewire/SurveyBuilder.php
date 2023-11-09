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

    public function addImage($parent = 0) 
    {   
        Element::create([
            'survey_id' => $this->survey,
            'type'      => 'image',
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
    {        //dd('updateText in SurveyBuilder', $propertyText, $propertyKey);
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
        if($type == 'linear_scale' || $type == 'multy_linear'){
            Element::where('id', $id)
            ->update(
                [
                    'type' => $type,
                    'opt' => '{"linear":5}'
                ]
            );  
        } else {
            Element::where('id', $id)
                ->update(['type' => $type]);  
        }
              
        $this->emit('refresh');
    }


    public function addFinalQuestions()
    { 
        $preFinal = Element::create([
            'survey_id' => $this->survey,
            'type'      => 'radio',
            'text'      => 'Wie viele Fahrzeuge haben Sie im Unternehmen?',
            'parent_id' => 0,
            'position'  => $this->nextPosition            
        ]);

        Element::insert([
            [
                'survey_id' => $this->survey,
                'text'      => 'bis 5',
                'parent_id' => $preFinal->id,
                'position'  => 1
            ],
            [
                'survey_id' => $this->survey,
                'text'      => '6 bis 10',
                'parent_id' => $preFinal->id,
                'position'  => 2
            ],
            [
                'survey_id' => $this->survey,
                'text'      => '11 bis 25',
                'parent_id' => $preFinal->id,
                'position'  => 3
            ],
            [
                'survey_id' => $this->survey,
                'text'      => '26 bis 50',
                'parent_id' => $preFinal->id,
                'position'  => 4
            ],
            [
                'survey_id' => $this->survey,
                'text'      => '51 bis 100',
                'parent_id' => $preFinal->id,
                'position'  => 5
            ],
            [
                'survey_id' => $this->survey,
                'text'      => '101 bis 250',
                'parent_id' => $preFinal->id,
                'position'  => 6
            ],
            [
                'survey_id' => $this->survey,
                'text'      => '251 bis 500',
                'parent_id' => $preFinal->id,
                'position'  => 7
            ],
            [
                'survey_id' => $this->survey,
                'text'      => 'über 501',
                'parent_id' => $preFinal->id,
                'position'  => 8
            ]
        ]);

        $final = Element::create([            
            'survey_id' => $this->survey,
            'type'      => 'final_question',
            'text'      => 'Davon entfallen',
            'parent_id' => 0,
            'position'  => $this->nextPosition+1
        ]);

        Element::insert([
            [
                'survey_id' => $this->survey,
                'parent_id' => $final->id,
                'position'  => 1
            ],
            [
                'survey_id' => $this->survey,
                'parent_id' => $final->id,
                'position'  => 2
            ],
            [
                'survey_id' => $this->survey,
                'parent_id' => $final->id,
                'position'  => 3
            ]            
        ]);      
    }


    public function finalQuestions($id, $type)
    { dd('finalQuestions');
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
