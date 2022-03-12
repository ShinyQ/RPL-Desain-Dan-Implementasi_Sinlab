<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->isMethod('post')){
            return [
                'name' =>['required'],
                'email'=>['required', 'email', 'unique:users'],
                'photo'=>[''],
                'password'=>['required'],
                'ktm'=>[''],
                'phone'=>[''],
            ];
        }else {
            return [
                'name' =>['string'],
                'email'=>['string','email'],
                'photo'=>['string'],
                'password'=>['string'],
                'ktm'=>['string'],
                'phone'=>['string'],
            ];
        }
    }
}
