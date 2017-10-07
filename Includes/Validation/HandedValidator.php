<?php

require_once("FieldValidatorBase.php");

class HandedValidator extends FieldValidatorBase
{
    public function IsValid($value, array $args) : bool
    {
        return !isset($value) || $value === "Left" || $value === "Right";
    }

    public function GetName() : string
    {
        return "isHand";
    }

    public function GetDefaultMessage() : string
    {
        return "Value must be either Left or Right";
    }
}

?>