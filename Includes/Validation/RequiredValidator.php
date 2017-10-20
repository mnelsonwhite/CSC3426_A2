<?php

require_once("FieldValidatorBase.php");

// Validates that the value exists
class RequiredValidator extends FieldValidatorBase
{
    public function IsValid($value, array $args) : bool
    {
        return is_bool($value) || !empty($value);
    }

    public function GetName() : string
    {
        return "required";
    }

    public function GetDefaultMessage() : string
    {
        return "This field is required";
    }
}

?>