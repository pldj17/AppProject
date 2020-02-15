<?php

namespace ProjectApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarPerfil extends FormRequest
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
            'phone' => 'numeric|min:11111|max:9999999999',
            'address' => 'required',
            'description' => 'required|min:5',
            'especialidad.*' => [
                'integer',
            ]
        ];
    }
}
