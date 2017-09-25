<?php

require_once("IFieldValidator.php");

class RequiredValidator implements IFieldValidator
{
    public function ValidateField($value, $args = true)
    {
        $message = "This field is required";
        
        if (is_array($args) && isset($args["message"]))
        {
            $message = $args["message"];
        }

        if (is_bool($args) && $args === false)
        {
            return true;
        }

        if (!is_bool($value) && empty($value))
        {
            return $message;
        }

        return true;
    }

    public function GetName() : string
    {
        return "required";
    }
}

?>