<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'fname' => ['required'],
            'lname' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required','unique:users,phone'],
            'password' => ['required','confirmed']
        ];
    }

    // custom message;
    public function messages(){
        return [
            'fname.required'=> 'First name is required',
            'lname.required'=> 'Last name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Provide a valid email',
            'email.unique'=> 'You need to provide an unique email.',
            'phone.required' => 'Phone is required',
            'phone.unique' => 'Already exists',
            'password' => 'You need to provide password',
            'password.confirmed'=> 'Password does not mathches'
        ];
    }
}
