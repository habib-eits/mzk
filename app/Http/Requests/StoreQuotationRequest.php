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
            'scope_of_work'=> 'nullable' ,
            'terms_and_conditions'=> 'nullable' ,

             // Validate details array
            'ItemID' => 'required|array|min:1',
            'service_type_id.*' => 'required|integer',
            'ItemID.*' => 'required|integer',
            'Description.*' => 'nullable|string',
            'UnitName.*' => 'required|string',
            'Rate.*' => 'required|numeric|min:0',
       
        ];
    }

    public function messages()
    {
        return [
            'ItemID.required' => 'At least one item detail is required',
            'service_type_id.*.required' => 'Service Type is required for all details',
            'ItemID.*.required' => 'Item is required for all details',
            'Rate.*.required' => 'Rate is required for all details',
        ];
    }
}
