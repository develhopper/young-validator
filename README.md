# young-validator

this is a module for young framework

its job is input validation

# Installation

```sh
composer require develhopper/young-validator
```

# Usage

## Validation

```php
<?php
// create new instance of validator
use Young\Modules\Validation\Validator;

$validator = Validator::getInstance();

$input = [
    "username" => "develhopper",
    "email" => "develhoper.0@gmail.com",
    "password" => "password",
    "age" => 23,
    "bio" => "" // optional. not required
];

$rules = [
    "username" => "required,string:30", //max lenght of string
    "email" => "required,email",
    "password" => "required,string,min:8" // required string with minimum 8 characters
    "age" => "required,int,min:18,max:100",
    "bio" => "string,min:30,max:255" // not required
];

$result = $validator->validate($input,$rules); // return true of false

if($result == false){
    var_dump($validator->messages); // vardump error messages of validations 
}

```

## Custom validation rules

### Custom Validation Class

the class must extend ValidationRule class

```php
<?php
use Yount\Modules\Validation\ValidationRule;

class CustomValidation extends ValidationRule{
    // if $name is not present in the class the name will be the first part of class name
    protected $name = "custom_name";

    // input is the actual input and the arg is arguments passed to rule
    // for example for rule min:30 the arg is 30
    public function validate($input,$arg){
        //set custom message
        $this->message = "field {field} must be greater than $arg";
        // or
        $this->message = "field {field} must be type of {type}";

        return $input >= $arg
    }
}
```

### Loading custom validation class

```php
<?php
$custom_validations = [
    CustomValidation::class
];

$validator = Validator::getInstance();

$validator->load($custom_validations);


```