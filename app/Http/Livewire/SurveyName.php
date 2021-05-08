<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Survey;

class SurveyName extends Component
{
    public $qid;
    public $name;
    public $surveyName;

    public function render()
    { 
        return view('livewire.survey-name', ['qid'=>$this->qid]);
    }

    public function updatedName(){

        
        Survey::where('id', $this->qid)
            ->update(['name' => $this->name]);
 
     }
}
