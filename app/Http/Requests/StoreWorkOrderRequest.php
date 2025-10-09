<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkOrderRequest extends FormRequest
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
            'id' => 'nullable|integer|exists:work_orders,id',
            'date' => 'required|date',
            'party_id' => 'required',
            'project_name' => 'required|string|max:255',
            'scope_of_work' => 'nullable|string',
            'terms_and_conditions' => 'nullable|string',
            'location' => 'nullable|string',
        ];
    }
}
