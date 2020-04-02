<?php

namespace ProjectApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarRating extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rating' => 'required',
            'title_rating' => 'nullable',
            'description_rating' => 'nullable',
        ];
    }
}
