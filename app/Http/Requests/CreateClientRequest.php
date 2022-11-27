<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
           'email' => 'required|email|string|unique:users,email',
           'password' => 'required|min:6|max:15',
           'name' => 'required|string|max:60',
           'companyName' => 'required|string|unique:users,company_name',
           'companyAddress' => 'required|string',
        ];
    }
}
