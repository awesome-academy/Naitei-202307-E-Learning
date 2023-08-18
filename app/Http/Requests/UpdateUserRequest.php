<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $user = auth()->user();

        return [
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'string',
                'max:11',
                'regex:/^[0-9()+-]*$/',
                Rule::unique('users')->ignore($user->id),
            ],
            'dob' => 'required|string|max:255',
            'avatar' => 'file|mimes:jpg,jpeg,png|max:512000',
        ];
    }
}
