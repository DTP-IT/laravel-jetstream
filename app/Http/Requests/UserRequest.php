<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required', 'current_password'],
            'confirmPassword' => ['same:password'],
            'role' => ['required', 'integer', 'exists:roles,id'],
        ];
    }

    /**
     * Send Message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute not be empty!',
            'email:rfc,dns' => ':attribute incorrect email address format!',
            'same:password' => ':attribute password does not match!',
            'string' => ':attribute only characters can be entered!',
            'max' => ':attribute up to 255 characters',
        ];
    }
}
