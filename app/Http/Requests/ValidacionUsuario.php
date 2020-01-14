<?php

namespace ProjectApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionUsuario extends FormRequest
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
        if ($this->route('id')) {
            return [
                'name' => 'required|max:50',
                'email' => 'required|email|max:100|unique:usuario,email,' . $this->route('id'),
                'password' => 'nullable|min:5',
                'role_id' => 'required|array'
            ];
        } else {
            return [
                'name' => 'required|max:50',
                'email' => 'required|email|max:100|unique:usuario,email,' . $this->route('id'),
                'password' => 'required|min:5',
                'role_id' => 'required|array'
            ];
        }
    }
}
