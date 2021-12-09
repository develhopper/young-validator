<?php
namespace Young\Modules\Validation\Rules;

use Young\Modules\Validation\ValidationRule;

class MinValidation extends ValidationRule{

    public function validate($input,$arg){
        if(is_numeric($input)){
            $this->message = "minimum value of {field} is $arg";
            return $input >= $arg;
        }else if(is_string($input)){
            if(strlen($input) < $arg){
                $this->message = "minimum length of {field} is $arg";
                return false;
            }
        }
        return true;
    }
}