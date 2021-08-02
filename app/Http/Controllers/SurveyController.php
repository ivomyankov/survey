<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FormServices;
use App\Models\Survey;
use App\Models\Element;

class SurveyController extends Controller
{
    public $colors = ['success', 'info', 'warning', 'danger', 'secondary', 'primary'];

    public function dashboard()
    {                  
        return view('dashboard.dash', ['dash' => 'dash']);  
    }

    public function getSurveys()
    {   
        $surveyObj = new Survey;
        $surveys = $surveyObj->getSurveysWithData(); 
        return view('dashboard.surveys', ['surveys' => $surveys, 'colors'=>$this->colors]);  
    }

    public function getResults(Survey $survey, FormServices $formServices)
    {
        $survey = $survey->getSurveyWithElementsAndData($survey->id);
        $surveyTree = $formServices->surveyTree($survey[0]->elements);
        $results = $formServices->results($survey[0]->data);
        
        //dd($survey[0], $results, $surveyTree);

        return view('dashboard.results', ['survey' => $survey[0], 'results'=>$results, 'surveyTree'=>$surveyTree]);  
    }

    public function getResultsPage(Survey $survey, FormServices $formServices)
    {   
        $survey = $survey->getSurveyWithElementsAndData($survey->id);
        $surveyTree = $formServices->surveyTree($survey[0]->elements);
        $results = $formServices->results($survey[0]->data);
        
        //dd($survey[0], $results, $surveyTree);

        return view('results', ['survey' => $survey[0], 'results'=>$results, 'surveyTree'=>$surveyTree]);  
    }


    public function newSurvey()
    {  
        $data = $this->validateSurvey(); 
        $survey = Survey::create($data);

        $hashSurvey = md5('survey/'.$survey->id);
        $hashResults = md5('survey/'.$survey->id.'/results');
        $hashSubmit = md5('survey/'.$survey->id.'/submit');

        $survey->update(['hash_survey'=>$hashSurvey, 'hash_results'=>$hashResults, 'hash_submit'=>$hashSubmit ]);

        return redirect()->route('getSurvey', ['survey'=>$survey->id]);
    }

    public function getSurvey(Survey $survey)
    {   
        return view('dashboard.survey', ['survey' => $survey]); 
    }



    public function update(Survey $survey)
    {   
        $data = $this->validateSurvey();
        //dd('ID:'.$survey->id, $data);
        $survey->update($data);

        //return redirect($survey->path());
        return response()->json($survey, 200);
    }

    public function getTrashedSurveys()
    {   
        return response()->json(Survey::onlyTrashed()->get(), 200);
    }

    public function delete(Survey $survey)
    {  
        $survey->forceDelete();

        //return redirect('/survey');
        return response()->json($survey, 204);
    }

    public function softDelete(Survey $survey)
    {  
        $survey->delete();

        //return redirect('/survey');
        return response()->json($survey, 204);
    }

    public function restore($id)
    {  
        $survey = Survey::onlyTrashed()->find($id);
        if (!is_null($survey)) {
            $survey->restore();
        } 
        //return redirect('/survey');
        return response()->json($survey, 204);
    }

    public function getSurveyPage($survey_id)
    {                  
        return view('dashboard.survey', ['survey_id' => $survey_id]);  
    }

    public function reposition($survey_id, Request $request)
    {    
        $newOrder = [];
        $oldOrder = [];
        $data = json_decode($request->getContent(), true);
        if($data['parent'] == 0){ 
            $element_id = (int)str_replace("sort_", "", $data['element_id']);
        } else { 
            $element_id = (int)str_replace("sub_", "", $data['element_id']);
        }
        $elementObj = new Element;
        $elements = $elementObj->getElementsByParentWithTrashed($data['parent']);         //dd($elements);

        foreach($elements as $key => $element){
            if($element->id != $element_id){    
                array_push($oldOrder, $element->id);      
            } 
        }

        foreach($oldOrder as $key => $element){
            if($key != $data['newIndex']){
                array_push($newOrder, $element);              
            } else {                
                array_push($newOrder, $element_id, $element);       
            }
        }
        
        //dd($oldOrder, $newOrder);

        foreach($newOrder as $key => $element){
            Element::withTrashed()
                ->where('id', $element)
                ->update(['position' => $key+1]);  
        }

        $data = [
            'success' => true,
            'message'=> $newOrder
        ];
        
        return response()->json($data);
    }

    public function goto(Element $element, Request $request)
    {    
        $info = json_decode($request->getContent(), true);
        if($info['go_to'] == 0){
            $element->update(['go_to'=>NULL]); 
        }else{
            $element->update($info);          
        }
        $data = [
            'success' => true,
            'message'=> $info
        ];
        
        return response()->json($data);
    }

    public function opt(Element $element, Request $request)
    {   
        //dd($element, json_decode($request->getContent(), true));
        $opt_request = json_decode($request->getContent(), true);
        $opt =  json_decode($element['opt'], true);  
        if(array_key_exists('go_to', $opt_request)){
            if(array_key_exists('show', $opt_request['go_to'])){
                $opt['go_to']['show'] = $opt_request['go_to']['show'];
            }
            if(array_key_exists('hide', $opt_request['go_to'])){
                $opt['go_to']['hide'] = $opt_request['go_to']['hide'];
            }
        }else if(array_key_exists('linear', $opt_request)){
            $opt['linear'] = $opt_request['linear'];
        }

        $element->update(['opt'=>json_encode($opt)]); 

        $data = [
            'success' => true,
            'message'=> $opt_request
        ];
        
        return response()->json($data);
    }

    public function hashUrl($hash, FormServices $formServices, Request $request){ 
        $surveyObj = new Survey;
        $surveys = $surveyObj->getSurveysHash(); 
        foreach ($surveys as $key => $survey) {
            if($survey->hash_survey == $hash){  
                return \App::call('App\Http\Controllers\FormController@buildSurvey', ["survey" => $survey]);
            } else if($survey->hash_results == $hash){
                return $this->getResultsPage($survey, $formServices);
            } else if($survey->hash_submit == $hash){
                //return \App::call('App\Http\Controllers\FormController@submitSurvey2', ["survey" => $survey, "request" => $request->all() ]);   
                return $this->test2($survey, $request->all() );                
            }
        }
    }

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


    // validation
    public function validateSurvey()
    {
        return request()->validate([
            'name' => 'min:3|max:50'
        ]);
    }

    

    public function test(Element $element, Request $request)
    {    
        $info = json_decode($request->getContent(), true);
        
        if($element->update($info)){
            $success = true;
        } else {
            $success = false;
        }

        $data = [
            'success'   =>  $success,
            'message'   =>  $info,
            'element'   =>  $element
        ];
        
        return response()->json($data);
    }


    
}
