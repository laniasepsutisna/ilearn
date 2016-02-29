<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AnnouncementRequest extends Request
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
            'title' => 'required|string|max:100|unique:announcements',
            'status' => 'required',
            'user_id' => 'exists:users,id',
            'content' => 'required|string'
        ];
    }

    /**
     * Return error message
     * @return array Array of message
     */
    public function messages() {
        return [
            'title.required' => 'Judul diperlukan!',
            'status.required' => 'Status urgensi diperlukan!',
            'content.required' => 'Konten diperlukan!',
        ];
    }
}
