<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuotationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'InvoiceMasterID' => 'nullable',
            'PartyID' => 'required',
            'Date'=> 'required',
            'DueDate'=> 'nullable' ,
            'TenderNo'=> 'nullable' ,
            'ReferenceNo'=> 'nullable' ,
            'ProjectName'=> 'nullable' ,
            'Attension'=> 'nullable' ,
            'Subject'=> 'nullable' ,

             // Validate details array
            'ItemID.*' => 'required|integer',
            'Description.*' => 'required|string',
            'UnitName.*' => 'required|string',
            'Rate.*' => 'required|numeric|min:0',
       
        ];
    }

    public function messages()
    {
        return [
            'ItemID.*required' => 'Item is required for all details',
            'Rate.*required' => 'Rate is required for all details',
        ];
    }
}
