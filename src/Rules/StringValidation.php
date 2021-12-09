<?php
namespace Young\Modules\Validation\Rules;

use Young\Modules\Validation\ValidationRule;

class StringValidation extends ValidationRule{

    public function validate($input,$arg){
        if($arg){
            if(is_string($input)){
                if(strlen($input) > $arg){
                    $this->message = "max length of {field} is $arg";
                    return false;
                }
                return true;
            }
        }
        return is_string($input);
    }
}