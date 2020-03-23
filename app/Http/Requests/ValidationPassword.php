<?php

namespace ProjectApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationPassword extends FormRequest
{
   
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            // 'old_password'          => 'required',
            // 'password'              => 'required|min:8',
            // 'password_confirmation' => 'required|confirmed'
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
