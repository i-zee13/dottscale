<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvestorRequest extends FormRequest
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
     * @return array
     */
    public function rules()
{
    return [
        'first_name' => [
            'required',
            'string',
            'min:2',
            'max:255', 
        ],
        'email' => [
            'required',
            'string',
            'email',
            'max:255', 
            Rule::unique('investors', 'email')->ignore($this->investor_id),
        ],
        'last_name' => [
            'required',
            'string',
            'min:2', 
            'max:200', 
        ],
        'investor_id' => [
            'nullable',
            'integer',
            Rule::exists('investors', 'id'),
        ],
        'country_id' => [
            'required',
            'integer',
            Rule::exists('countries', 'id'),
        ],
        'city_id' => [
            'required',
            'integer',
            Rule::exists('cities', 'id'),
        ],
        'state_id' => [
            'required',
            'integer',
            Rule::exists('states', 'id'),
        ],
    ];
}

public function messages()
{
    return [
        'country.exists' => 'The selected country does not exist.',
        'city.exists' => 'The selected city does not exist.',
        'state.exists' => 'The selected state does not exist.',
    ];
}

}
