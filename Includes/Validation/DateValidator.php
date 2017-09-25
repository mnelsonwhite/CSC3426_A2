<?php

require_once("IFieldValidator.php");

abstract class FieldValidator implements IFieldValidator
{

    public abstract function GetName() : string;
    public abstract function IsValid($value) : bool;
    public abstract function GetDefaultMessage() : string;

    public function ValidateField($value, $args = true)
    {
        $message = $this->GetDefaultMessage();;

        if (is_array($args) && isset($args["message"]))
        {
            $message = $args["message"];
        }

        if (is_bool($args) && $args === false)
        {
            return true;
        }

        return $this->IsValid($value) ? true : $message;
    }
}

?>