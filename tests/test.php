<?php

include __DIR__."/autoload.php";

use validations\IntValidation;
use Young\Modules\Validation\Validator;

$validations = [
    IntValidation::class
];
$validator = Validator::getInstance();
// $validator->load($validations);

$input = [
    "number"=>1,
    "email"=>"email@mail.com",
    "age" => 50,
    "message"=>"hello worldss"
];

$result = $validator->validate($input,[
    "number" =>  "int",
    "email" => "email",
    "age" => "int,min:18,max:100",
    "message" => "string:12"
]);

if($result == false){
    var_dump($validator->messages);
}

$input = [
    "number"=>1,
    "email"=>"email@mail.com",
    "age" => 17,
    "message"=>""
];

$result = $validator->validate($input,[
    "number" =>  "int",
    "email" => "email",
    "age" => "int,min:18,max:100",
    "message" => "required,string,min:4,max:30"
]);

var_dump($validator->messages);