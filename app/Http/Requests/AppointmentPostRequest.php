<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentPostRequest extends FormRequest
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
            'time' => 'date|required|after:'.now(),
            'child_id' => 'exists:children,id,deleted_at,NULL|required',
        ];
    }

    public function attributes()
    {
        return [
            'time' => 'Waktu janji temu',
            'child_id' => 'Data anak',
        ];
    }
}
