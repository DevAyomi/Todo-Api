<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditClientRequest extends FormRequest
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
           'email' => ['nullable','email','string', Rule::unique('users')->ignore($this->user)],
           'password' => 'nullable',
           'name' => 'nullable|string|max:60',
           'companyName' => 'nullable|string|unique:users,company_name',
           'companyAddress' => 'nullable|string',
        ];
    }
}
