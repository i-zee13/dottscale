<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationValidate extends FormRequest
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
            'career_id'     => 'required',
            'first_name'    => 'required|string|max:255',
            'linkedInUrl'           => 'required|string',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone_number'  => 'required|string|max:20',
            'introduction'  => 'required',
            'resume'        => 'required|file|mimes:pdf,doc,docx',
        ];
    }

    /**
     * Get the validated data and sanitize it.
     *
     * @return array
     */
    public function sanitizedAndValidated()
    {
        $validatedData = $this->validated();
        foreach ($validatedData as $key => $value) {
            if (is_string($value)) {
                $validatedData[$key] = $this->sanitizeInput($value);
            }
        }

        return $validatedData;
    }

    /**
     * Sanitize input data.
     *
     * @param string $input
     * @return string
     */
    private function sanitizeInput($input)
    {
        $input = strip_tags($input);
        return $input;
    }
}
