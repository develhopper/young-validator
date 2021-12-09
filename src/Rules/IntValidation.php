<?php

namespace Young\Modules\Validation\Rules;

use Young\Modules\Validation\ValidationRule;

class IntValidation extends ValidationRule{

    public function validate($input, $arg){
        return is_int($input);
    }
}