<?php

namespace App\Http\Requests\company;

use Illuminate\Foundation\Http\FormRequest;

class Upsert extends FormRequest
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
        $rules = [
            'name' => 'required',
            'logo' => 'nullable|mimes:jpeg,png,jpg',
            'website' => ['nullable', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
        ];

        // When update the company the check unique email validation
        if (isset($this->company->id)) {
            $rules += [
                'email' => 'required|email|unique:companies,email,' . $this->company->id . ',id,deleted_at,NULL',
            ];
        } else {
            $rules += [
                'email' => 'required|email|unique:companies,email',
            ];
        }
        return $rules;
    }
}
