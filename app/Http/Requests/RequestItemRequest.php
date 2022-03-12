<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestItemRequest extends FormRequest
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
                'user_id' =>['required','exists:users.id'],
                'admin_id'=>['required','exists:users.id'],
                'name' =>['required','exists:users.name'],
                'status'=>['required'],
                'description'=>[''],
                'qty'=>[''],
                'feedback'=>[''],
            ];
        }else {
            return [
                'user_id' =>['exists:users.id'],
                'admin_id'=>['exists:users.id'],
                'name' =>['exists:users.name'],
                'status'=>['string'],
                'description'=>['string'],
                'qty'=>[''],
                'feedback'=>['string'],
            ];
        }
    }
}
