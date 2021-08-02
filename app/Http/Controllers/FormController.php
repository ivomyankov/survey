<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyStoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Element;
use App\Models\Data;

class FormController extends Controller
{

    public function buildSurvey(Survey $survey)
    {   
        //dd($survey->getSurveysWithElements()[$survey->id-1]);
        $survey = $survey->getSurveysWithElements()[$survey->id-1];
        //$elementObj = new Element;
        //$options = $elementObj->getOptions($survey->id); 
        $raw_elements = $survey->elements;
        $required = [];
        $parents = [];
        $options = [];
        
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
            if(!is_null($element->opt) || $element->opt != ''){
                $opt = json_decode($element->opt, true);
                if (array_key_exists('go_to', $opt)) {
                    if (array_key_exists('hide', $opt['go_to']) && $opt['go_to']['hide'] != '') {
                        $options[$element->id]['hide'] = $opt['go_to']['hide'];
                    }
                    if (array_key_exists('show', $opt['go_to']) && $opt['go_to']['show'] != '') {
                        $options[$element->id]['show'] = $opt['go_to']['show'];
                    }
                }
                //dd($options);
            }

            foreach($parents as $key2 => $value){ 
                if($element->parent_id == $key2){                             
                    $parents[$key2][$key]=$element; 
                    unset($raw_elements[$key]);                    
                } 
            }
        }

        // replaces id's of parent multy_radio & checkbox with child's
        $required = $this->required($parents, $required);
    
        //dd($raw_elements, $parents, $required, $options);

        return view('survey', ['survey' => $survey, 'elements'=>$parents, 'required'=>$required, 'options'=>$options]);  
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
/*
    public function checkHash($hash){ 
        $surveyObj = new Survey;
        $surveys = $surveyObj->getSurveysHash(); 
        foreach ($surveys as $key => $survey) {
            if($survey->hash_survey == $hash){  
                //return \App::call('App\Http\Controllers\FormController@buildSurvey', ["survey" => $survey]);
            } else if($survey->hash_results == $hash){
                //return $this->getResultsPage($survey, $formServices);
            } else if($survey->hash_submit == $hash){
                //return \App::call('App\Http\Controllers\FormController@submitSurvey2', ["survey" => $survey, "request" => $request->all() ]);   
                return $survey;             
            }        
        }
    }
*/
    public function ajaxPostForm($hash, SurveyStoreRequest $request)
    {   
        $surveyObj = new Survey;
        $survey = $surveyObj->getSurveysIdByHash($hash); 

        $success = false;

        // Will return only validated data            
        $validated = $request->validated(); 
        
        if($survey){
            if ($this->submitApiForm($validated, $survey[0]->id)){
                $success = true;
            }
        } 
        
        $data = [
            'data'   => $validated,
            'success'   => $success
        ];
        

        
        return response()->json($data);
    }
/*
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
        
        $log = Data::create( $data); 
        //return Data::create( $data);
        if($log){
            $msg = 'ok';
        } else {
            $msg = 'error';
        }

        return redirect()->back()->with(compact('msg'));
        //return redirect('/exit', compact('user','identity','pallet','categories','warehouses'));  
        //return redirect('/exit', ['msg' => $msg, 'log' => $log]);         
    }
*/
    private function submitApiForm($validated, $survey_id)
    {     
        // save validated to public/storage
        Storage::disk('public')->append('survey_'.$survey_id.'.txt', "\n".$this->clientIp()."\n".date("F j, Y, g:i a")."\n".var_export($validated, TRUE));

        foreach($validated as $key => $value){
            if(is_array($value)){
                $validated[$key] = "[".implode (", ", array_values($value))."]";
            }
        }
        //dd($validated, $survey_id);
        
        $data = [
            'survey_id' => $survey_id,
            'data'    => json_encode($validated),
        ];
        
        if (Data::create( $data)){
            return true;
        }
        
        return false;
     
    }

    private function clientIp(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}
