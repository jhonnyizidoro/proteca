<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPersonRequest extends FormRequest
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
            'name' => 'required|string|max:191|min:3',
			'email' => 'nullable|email|max:191|required_if:type,team',
			'link' => 'nullable|url|max:191|required_if:type,partner',
            'image' => 'required|mimes:jpeg,jpg,png',
            'type' => 'required|in:partner,team',
            'presentation' => 'required|string|max:65000|required_if:type,team',
        ];
    }
    
}
