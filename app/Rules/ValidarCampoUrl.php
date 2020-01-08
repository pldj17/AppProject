<?php

namespace ProjectApp\Rules;

use Illuminate\Contracts\Validation\Rule;
use ProjectApp\Menu;

class ValidarCampoUrl implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) //attribute es el Url y value es el valor que llega
    {
        if($value != '#'){//buscamos si ese registro ya esta en la db
            $menu = Menu::where($attribute, $value)->get();
            return $menu->isEmpty();
        }
        return true; //si es diferente a # retornar true
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Esta Url está asignada';
    }
}
