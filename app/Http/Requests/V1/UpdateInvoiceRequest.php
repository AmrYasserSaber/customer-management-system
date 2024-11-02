<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class  UpdateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this ->user();

        return $user != null && $user->tokenCan('update:invoice');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method =$this->method();
        if($method == 'PUT'){
            return [
                'customerId'=>['required'],
                'amount'=>['required','numeric'],
                'status'=>['required',Rule::in(['V','B','P','v','b','p'])],
                'billedDate'=>['required','date_format:Y-m-d H:i:s'],
                'paidDate'=>['date_format:Y-m-d H:i:s','nullable'],
            ];
        } else {
            return [
                'customerId'=>['sometimes','required'],
                'amount'=>['sometimes','required','numeric'],
                'status'=>['sometimes','required',Rule::in(['V','B','P','v','b','p'])],
                'billedDate'=>['sometimes','required','date_format:Y-m-d H:i:s'],
                'paidDate'=>['sometimes','date_format:Y-m-d H:i:s','nullable'],
            ];
        }
    }
    protected  function  prepareForValidation(): void
    {
        if ($this->customerId){
            $this->merge([
                'customer_id'=>$this->customerId
            ]);
        }
        if ($this->billedDate){
            $this->merge([
                'billed_date'=>$this->billedDate
            ]);
        }
        if ($this->paidDate){
            $this->merge([
                'paid_date'=>$this->paidDate
            ]);
        }
    }
}
