<?php

require_once("FieldValidatorBase.php");

class IntegerValidator extends FieldValidatorBase
{
    public function IsValid($value, array $args) : bool
    {
        return !isset($value) || filter_var($value, FILTER_VALIDATE_INT);
    }

    public function GetName() : string
    {
        return "integer";
    }

    public function GetDefaultMessage() : string
    {
        return "Value must be an integer";
    }
}

?>