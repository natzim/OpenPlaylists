<?php namespace App\Services;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator {

    public function validateNotReserved($attribute, $value, $parameters)
    {
        $reserved = [
            'create',
        ];

        return !in_array($value, $reserved);
    }

}