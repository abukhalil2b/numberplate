<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ar_branchname' => 'required',
            'en_branchname' => 'required',
            'email' => 'required|unique:users',
        ];
    }

    public function messages()
    {
        return[
            'ar_branchname.required'=>' The arabic branchname field is required. ',
            'en_branchname.required'=>' The english branchname field is required. ',
            'email.required'=>' The username field is required. ',
            'email.unique'=>' The username has already been taken. ',
        ];
    }
}
