<?php
namespace Young\Modules\Validation\Rules;

use Young\Modules\Validation\ValidationRule;

class EmailValidation extends ValidationRule{

    public function validate($input,$arg){
        return preg_match("/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/",$input,$match);
    }
}