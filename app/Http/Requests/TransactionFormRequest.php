<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CustDate;
use Auth;

class TransactionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->tr_date);
        return [
            'amount' => ['required', 'numeric'],
            'description' => ['required'],
            'tr_date' => ['required', new CustDate],
            'tr_type' => ['required', 'in:CR,DB']
        ];
    }
}
