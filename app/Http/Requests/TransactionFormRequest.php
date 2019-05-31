<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CustDate;
use App\Transaction;
use Carbon\Carbon;
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


    public function saveTransaction(Transaction $transaction)
    {
        $transaction->amount = $this->amount;
        $transaction->description = $this->description;
        $transaction->tr_date = Carbon::createFromFormat('d M, Y', $this->tr_date);
        $transaction->tr_type = $this->tr_type;
        $transaction->user = Auth::user();
        $transaction->save();
    }
}
