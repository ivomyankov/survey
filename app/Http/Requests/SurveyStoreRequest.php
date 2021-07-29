<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($this->request, $this->request->get('required'));
        $required = explode(',' ,$this->request->get('required'));
             
        //dd($this->request, $required);
        foreach($this->request as $key => $val){          
            if (substr($key, -1) == 's' || substr($key, -1) == 't'){
                if ($val != NULL && $val != ''){
                    
                    $rules[$key] = 'max:1000';
                }                
            } else if($key[0] == 'q' ){
                $rules[$key] = 'max:100';
            }

            if (in_array(substr($key, 1), $required)) {
                $key2 = array_search(substr($key, 1), $required); 
                $rules[$key] .= '|required';
                unset($required[$key2]);
            } 
        }
        if (!empty($required[0])){ 
            foreach ($required as $key => $value) {
                $rules['q'.$value] = 'required';
                unset($required[$key]);
            }
        }

        //dd($rules);      

        return $rules;

        /*return [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'password' => 'required'
        ];*/
    }

    public function messages()
    {
        return [
            //'email.required' => 'Email is required!',
            //'name.required' => 'Name is required!',
            //'password.required' => 'Password is required!'
        ];
    }
}
