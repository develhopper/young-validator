<?php

include __DIR__."/autoload.php";

use validations\IntValidation;
use validations\TypeValidation;
use Young\Modules\Validation\Validator;

$validations = [
    IntValidation::class,
    TypeValidation::class
];
$validator = Validator::getInstance();
$validator->load($validations);

$input = [
    "number"=>1,
    "email"=>"email@mail.com",
    "age" => 50,
    "message"=>"hello worldss"
];

$result = $validator->validate($input,[
    "number" =>  "int",
    "email" => "email",
    "age" => "int|min:18|max:100",
    "message" => "string:12"
]);

if($result == false){
    // var_dump($validator->messages);
}

$input = [
    "number"=>1,
    "email"=>"test",
    "age" => 17,
    "message"=>""
];

$result = $validator->validate($input,[
    "number" =>  "int",
    "email" => "required|email",
    "age" => "int|min:18|max:100",
    "message" => "required|string|min:4|max:30"
]);

// var_dump($validator->messages);

$input = [
    "test" => "giff"
];

$result = $validator->validate($input, [
    "test" => "required|string|type:gif,jpg,png"
]);

var_dump($validator->messages);