<?php

require_once("FieldValidatorBase.php");

// Validate value as either Left or Right
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