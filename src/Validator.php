<?php

namespace Young\Modules\Validation;

use ReflectionClass;
use Young\Modules\Validation\Rules\EmailValidation;
use Young\Modules\Validation\Rules\IntValidation;
use Young\Modules\Validation\Rules\MaxValidation;
use Young\Modules\Validation\Rules\MinValidation;
use Young\Modules\Validation\Rules\StringValidation;

class Validator{

    public $validations = [];
    public $messages = [];
    private static $INSTANCE = null;

    private function __construct()
    {
        $validations = [
            IntValidation::class,
            MinValidation::class,
            MaxValidation::class,
            StringValidation::class,
            EmailValidation::class
        ];

        $this->load($validations);
    }

    public static function getInstance(){
        if(self::$INSTANCE == null)
            self::$INSTANCE = new Validator();
        return self::$INSTANCE;
    }

    public function load(array $validations){
        foreach($validations as $validation){
            $this->validations[$this->getValidationName($validation)] = $validation;
        }
    }

    public function validate($input,$rules){
        $is_valid = true;
        $this->messages = [];

        foreach($rules as $field => $rule){
            if(!isset($input[$field])){
                $input[$field] = "";
            }
            $error = $this->error($input[$field], $rule);
            if($error){
                $this->messages[$field] = str_replace("{field}",$field,$error);
                $is_valid = false;
            }
        }
        return $is_valid;
    }

    private function error($var,$rule){
        $rules=explode(",",$rule);
        $required = false;
        
        if(in_array('required',$rules)){
            $required = true;
        }

        if(empty(trim($var))){
            if($required)
                return "field {field} is required";
            else
                return;
        }
        foreach($rules as $rule){
            $rule_parts=explode(":",$rule);
            $rule_name = $rule_parts[0];
            $arg[0]=$var;
            $arg[1]=(count($rule_parts)>1)?$rule_parts[1]:[];
            if($rule_name == "required")
                continue;
            $validator = new $this->validations[$rule_name];
            if(!call_user_func_array([$validator ,'validate'],$arg)){
                return str_replace("{type}",$rule_name,$validator->message);
            }
        }
    }

    private function getValidationName($validation){
        $reflection = new ReflectionClass($validation);
        
        $name = $reflection->getShortName();
        $properties = $reflection->getDefaultProperties();
        if(isset($properties['name'])){
            $name = $properties['name'];
        }
        else{
            $name = preg_split("/(^[^A-Z]+|[A-Z][^A-Z]+)/",$name,-1,
            PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
            $name = strtolower($name[0]);
        }
        return $name;
    }
}