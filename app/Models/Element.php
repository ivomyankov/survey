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

    public function getElementsByParent($parent)
    {
        $elements = Element::where('parent_id', $parent)
                        ->orderBy('position', 'ASC')
                        ->get();
        return $elements;
    }

    public function getOptions($survey)
    {
        $options = Element::where('survey_id', $survey)
                        ->whereNotNull('opt')
                        ->orderBy('id', 'ASC')
                        ->get();
        return $options;
    }


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
            'time',
            'percentage'
        ];
    }

    
}
