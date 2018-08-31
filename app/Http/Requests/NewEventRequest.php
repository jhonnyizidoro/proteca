<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewEventRequest extends FormRequest
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
            'location' => 'required|string|max:191|min:3',
            'date' => 'required|date_format:d/m/Y',
            'starts_at' => 'required|date_format:H:i',
            'ends_at' => 'required|date_format:H:i',
            'url' => 'nullable|url|max:191',
            'organizer' => 'nullable|string|max:191|min:3',
            'details' => 'required|string|max:65000',
        ];
    }
}
