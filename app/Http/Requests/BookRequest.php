<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => ['required', 'alpha_dash', 'max:255'],
            'publisher' => ['required', 'max:255'],
            'category' => ['required', 'integer', 'exists:categories,id'],
            'quantity' => ['integer', 'min:0'],
            'price' => ['numeric', 'min:0']
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
            'integer' => ':attribute integers can only be entered!',
            'numeric' => ':attribute incorrect number format!',
            'min' => ':attribute must be greater than 0!',
            'max' => ':attribute up to 255 characters',
        ];
    }
}
