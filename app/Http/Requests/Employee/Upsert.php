<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class Upsert extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'company_id' => 'required|exists:companies,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric|digits:10',
        ];

        // When update the employees the check unique email validation
        if (isset($this->employees->id)) {
            $rules += [
                'email' => 'required|email|unique:employees,email,' . $this->employees->id . ',id,deleted_at,NULL',
            ];
        } else {
            $rules += [
                'email' => 'required|email|unique:employees,email',
            ];
        }
        return $rules;
    }

}
