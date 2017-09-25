<?php

require_once("IFieldValidator.php");

abstract class FieldValidatorBase implements IFieldValidator
{

    public abstract function GetName() : string;
    public abstract function IsValid($value, array $args) : bool;
    public abstract function GetDefaultMessage() : string;

    public function ValidateField($value, $args = [])
    {
        $message = $args["message"] ?? $this->GetDefaultMessage();
        return $this->IsValid($value, $args) ? true : $message;
    }
}

?>