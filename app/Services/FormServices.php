<?php

namespace App\Services;

class FormServices 
{

    public function surveyTree($raw_elements)
    { 
        $required = [];
        $surveyTree = [];

        foreach($raw_elements as $key => $element){
            if($element->parent_id == 0){
                if($element->required == 1){
                    // $required - array of IDs that are required
                    array_push($required, $element->id);
                }          
                $surveyTree[$element->id][0]=$element;
                unset($raw_elements[$key]);
            }
            
        }

        foreach($raw_elements as $key => $element){
            foreach($surveyTree as $key2 => $value){ 
                if($element->parent_id == $key2){                             
                    $surveyTree[$key2][$key]=$element; 
                    unset($raw_elements[$key]);                    
                } 
            }
        }
        return $surveyTree;
    }

    public function results($dbData)
    {
        $results = [];
        foreach ($dbData as $key => $value) {
            $data = json_decode($value->data);      
            //dd($data);      
            foreach ($data as $key2 => $value2) {
                if(!isset($results[$key2])){
                    $results[$key2]=[];
                }
                array_push($results[$key2], $value2);
            }            
        }

        return $results;
    }
}