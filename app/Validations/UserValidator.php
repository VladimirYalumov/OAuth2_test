<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;
 
class UserValidator
{
    public static function validate($input)
    {
        $rules = [
            'name' => 'string',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:App\Entities\User',
            'password' => 'required|string|'
        ];

        return Validator::make($input, $rules);
    }
}