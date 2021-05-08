<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data;

class Element extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'element';
    public $timestamps  = false;


    public function survey()
    {
        return $this->belongsTo(Survey::class, 'id', 'survey_id');
    }

    public function data()
    {
        return $this->hasMany(Data::class, 'element_id', 'id');
    }

/*
    public function getparents($quiz_id)
    {
        $parents = Elements::select('parent_id')
                        ->where('quiz_id', $quiz_id)
                        ->orderBy('parent_id', 'ASC')
                        ->distinct()
                        ->get();
        return $parents;
    }
*/
    public static function types()
    {
        return [
            'checkbox',
            'radio',
            'long_text',
            'short_text',
            'dropdown',
            'multy_checkbox',
            'multy_radio',
            'linear_scale',
            'date',
            'time'
        ];
    }

    
}
