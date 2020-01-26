<?php

namespace ProjectApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarPost extends FormRequest
{
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
            'photo' => 'required|image',
        ];
    }

    public function messages() 
    {
        return [
            'photo.required' => 'No has seleccionado ningun archivo.',
            'photo.image' => 'Debes subir una imagen.',
        ];
    }
}
