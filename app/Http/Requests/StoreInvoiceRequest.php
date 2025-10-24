<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'ProjectEngg'=> 'nullable' ,
            'Attension'=> 'nullable' ,
            'Subject'=> 'nullable' ,

             // Validate details array
            'ItemID' => 'required|array|min:1',
            'service_type_id.*' => 'required|integer',
            'ItemID.*' => 'required|integer',
            'Description.*' => 'nullable|string',
            'UnitName.*' => 'required|string',
            'Previous.*' => 'required|numeric|min:0',
            'Current.*' => 'required|numeric|min:0',
            'Cumulative.*' => 'required|numeric|min:0',
            'Rate.*' => 'required|numeric|min:0',
            'Total.*' => 'required|numeric|min:0',
       
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
