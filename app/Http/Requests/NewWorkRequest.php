<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewWorkRequest extends FormRequest
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
            'title' => 'required|string|max:191|min:6',
            'file' => 'required|file',
            'abstract' => 'required|string|max:16000000',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
