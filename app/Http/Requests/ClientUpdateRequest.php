<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('admin.client.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'phone' => 'required',
            'abn_number' => 'required',
            'branch' => 'required',
            'tax_file_number' => 'required',
            'street_address' => 'required',
            'suburb' => 'required',
            'state' => 'required',
            'post_code' => 'required',
            'country' => 'required',
            'agent_name' => 'required',
            'agent_number' => 'required',
            'agent_abn_number' => 'required',
            'services' => 'required',
            'professions' => 'required',
        ];
    }
}
