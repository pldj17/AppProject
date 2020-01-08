<?php

namespace ProjectApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ProjectApp\Rules\ValidarCampoUrl;

class ValidacionMenu extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:50|unique:menus,name,' . $this->route('id'),
            'url' => ['required', 'max:100', new ValidarCampoUrl],
            'icon' => 'nullable|max:50'
        ];
    }

    public function messeges(){
        return [
            'name.required' => 'El campo Nombre es obligatorio',
            'url.required' => 'El campo Url es obligatorio', 
        ];
    }
}
