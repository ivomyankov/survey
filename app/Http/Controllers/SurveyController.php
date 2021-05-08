<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FormServices;
use App\Models\Survey;

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


    public function newSurvey()
    {  
        $data = $this->validateSurvey();
        $survey = Survey::create($data);

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


    // validation
    public function validateSurvey()
    {
        return request()->validate([
            'name' => 'min:3|max:50'
        ]);
    }

    
}
