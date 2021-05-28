<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Element;
use App\Models\Data;

class Survey extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'survey';
    public $timestamps  = false;
    /*
    public function data()
    {
        return $this->hasManyThrough(Data::class, Element::class, 'survey_id', 'element_id', 'id', 'id');
    }
    */
    public function data()
    { 
        return $this->hasMany(Data::class, 'survey_id', 'id');
    }

    public function elements()
    {
        return $this->hasMany(Element::class, 'survey_id', 'id')
                ->orderBy('parent_id', 'ASC')
                ->orderBy('position', 'ASC');
        
    }

    public function getSurveysWithElements()
    {
        $surveys = Survey::with(['elements'])
                        ->get();
        return $surveys;
    }

    public function getSurveysWithData()
    {
        $surveys = Survey::with(['data'])
                        ->get();
        return $surveys;
    }

    public function getSurveyWithElementsByParent($id, $parent)
    {
        $survey = Survey::with(['elements'])
                        ->where('id', $id)
                        ->get();
        return $survey;
    }

    public function getSurveyWithElementsAndData($id)
    {
        $survey = Survey::with(['data'])
                        ->with(['elements'])
                        ->where('id', $id)
                        ->get();
        return $survey;
    }

    public function getSurveysHash()
    {
        $surveys = Survey::all();
        return $surveys;
    }


/*





    public function childElements()
    {
        return $this->hasMany(Elements::class, 'quiz_id', 'id')
                ->where('parent_id', '>', 0)
                ->orderBy('parent_id', 'ASC');
    }

    

    public function getQuiz($id)
    {
        $quiz = Quiz::where('id', $id)
                        ->with(['elements', 'data'])
                        //->with(['childElements', 'data'])
                        ->get();
        return $quiz;
    }

    public function getQuizWithData($id)
    {
        $quiz = Quiz::where('id', $id)
                        ->with(['elements', 'data'])
                        ->get();
        return $quiz;
    }
*/

}
