<?php

require_once("FieldValidatorBase.php");

class RequiredValidator extends FieldValidatorBase
{
    public function IsValid($value) : bool
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