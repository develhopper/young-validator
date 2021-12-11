<?php

namespace validations;

use Young\Modules\Validation\ValidationRule;

class TypeValidation extends ValidationRule{
    public function validate($input,$args){
        $this->message = "field {field} valid types are ".implode(',',$args);
        foreach($args as $type){
            if($input == $type)
                return true;
        }
    }
}