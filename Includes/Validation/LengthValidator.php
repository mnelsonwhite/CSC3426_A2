<?php

require_once("FieldValidatorBase.php");

class LengthValidator extends FieldValidatorBase
{
    public function IsValid($value, array $args) : bool
    {
        $eq = !array_key_exists("eq", $args) || strlen($value) == $args["eq"];
        $gt = !array_key_exists("gt", $args) || strlen($value) > $args["gt"];
        $lt = !array_key_exists("lt", $args) || strlen($value) < $args["lt"];
        
        return !isset($value) || ($eq && $gt && $lt);
    }

    public function GetName() : string
    {
        return "length";
    }

    public function GetDefaultMessage() : string
    {
        return "Length of string out of range";
    }
}

?>