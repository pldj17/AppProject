<?php

namespace ProjectApp\Rules;

use Illuminate\Contracts\Validation\Rule;
use ProjectApp\Menu;

class ValidarCampoUrl implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value) //attribute es el Url y value es el valor que llega
    {
        if($value != '#'){//buscamos si ese registro ya esta en la db
            $menu = Menu::where($attribute, $value)->where('id', '!=', request()->route('id'))->get();
            return $menu->isEmpty();
        }
        return true; //si es diferente a # retornar true
    }

    public function message()
    {
        return 'Esta Url está asignada';
    }
}
