<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
                'user_id' =>['required','exists:user.id'],
                'admin_id'=>['required','exists:user.id'],
                'status'=>['required'],
                'deadline'=>[''],
                'feedback'=>[''],
            ];
        }else {
            return [
                'user_id' =>['exists:user.id'],
                'admin_id'=>['exists:user.id'],
                'status'=>['string'],
                'deadline'=>[''],
                'feedback'=>['string'],
            ];
        }
    }
}
