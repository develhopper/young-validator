<?php

namespace Young\Modules\Validation;

abstract class ValidationRule{
    protected $name;
    protected $message = "field {field} must be type of {type}";

    abstract function validate($input,$arg);

    public function __get($name)
    {
        return $this->$name;
    }
}