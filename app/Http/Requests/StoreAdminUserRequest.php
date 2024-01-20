<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class StoreAdminUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role_title' => 'required',
            'ar_name' => 'required',
            'en_name' => 'required',
            'email' => ['required','unique:' . User::class]
        ];
    }

    public function messages(): array
    {
        return [
            'role_title.required' => 'profile is required',
            'ar_name.required' => 'arabic name of user is  required',
            'en_name.required' => 'english name of user is  required',
            'email.required' => 'The username required',
        ];
    }
}
