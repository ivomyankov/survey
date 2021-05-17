<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyStoreRequest;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Data;

class FormController extends Controller
{

    public function buildSurvey(Survey $survey)
    {   
        //dd($survey->getSurveysWithElements()[$survey->id-1]);
        $survey = $survey->getSurveysWithElements()[$survey->id-1];
        $raw_elements = $survey->elements;
        $required = [];
        
        //TO DO -> This part is moved to Services/FormServices. Required have to be figured out and remove most of code
        foreach($raw_elements as $key => $element){
            if($element->parent_id == 0){
                if($element->required == 1){
                    // $required - array of IDs that are required
                    array_push($required, $element->id);
                }          
                $parents[$element->id][0]=$element;
                unset($raw_elements[$key]);
            }
            
        }
        
        foreach($raw_elements as $key => $element){
            foreach($parents as $key2 => $value){ 
                if($element->parent_id == $key2){                             
                    $parents[$key2][$key]=$element; 
                    unset($raw_elements[$key]);                    
                } 
            }
        }

        // replaces id's of parent multy_radio & checkbox with child's
        $required = $this->required($parents, $required);
    
        //dd($raw_elements, $parents, $required);

        $survey = $survey->getSurveysWithElements()[0];
        return view('survey', ['survey' => $survey, 'elements'=>$parents, 'required'=>$required]);  
    }

    public function required($parents, $required)
    {
        //dd($parents, $required);    
        // If any multy_radio or multy_checkbox are required, the id's of the subbs are added to $required    
        foreach ($required as $key => $element) {
            if($parents[$element][0]->type == 'multy_checkbox' || $parents[$element][0]->type == 'multy_radio'){
                unset($required[$key]);
                unset($parents[$element][0]);
                foreach (array_reverse($parents[$element]) as $key2 => $option) {
                    if($option->type != 'short_text' && $option->type != 'col'){
                        array_unshift($required, $option->id);
                    }                    
                }            
            
            }
        }
        return $required;  
    }

    public function submitSurvey(SurveyStoreRequest $request, $survey_id)
    {
        // Will return only validated data            
        $validated = $request->validated();
        
        foreach($validated as $key => $value){
            if(is_array($value)){
                $validated[$key] = "[".implode (", ", array_values($value))."]";
            }
        }
        //dd($validated);
        //$keys = implode (", ", array_keys($validated));
        //$values = implode ("| ", array_values($validated));
        $data = [
            'survey_id' => $survey_id,
            'data'    => json_encode($validated),
        ];
        
        
        return Data::create( $data);
        
    }
}
