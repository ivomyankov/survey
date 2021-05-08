<?php

namespace App\Models;
use App\Models\Element;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    //use HasFactory;

    protected $guarded = [];
    protected $table = 'data';
    public $timestamps  = false;

    public function Question()
    {
        return $this->belongsTo(Element::Class,'element_id');
    }

    public function deleteElementsData($elements)
    {
        $idsToDelete = array();  
        $element = json_decode($elements);
        
        foreach ($element[0]->data as $data) {
            array_push($idsToDelete, $data->id);
        }       
        //dd($idsToDelete);
        // $idsToDelete array of ids to delete
        Data::destroy($idsToDelete);        

        return ;
    }
    

}
