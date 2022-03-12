<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionItemRequest extends FormRequest
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
                'transaction_id' => ['required', 'exists:transaction'],
                'item_id' => ['required', 'exists:item.id'],
                'qty' => ['required'],
            ];
        }else {
            return [
                'transaction_id' => ['exists:transaction.id'],
                'item_id' => ['exists:item.id'],
                'qty' => [],
            ];
        }
    }
}
