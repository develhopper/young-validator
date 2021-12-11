<?php

namespace validations;

use Young\Modules\Validation\ValidationRule;

class IntValidation extends ValidationRule{
    // protected $name = "int";

    public function validate($input,$arg){
        return is_int($input);
    }
}