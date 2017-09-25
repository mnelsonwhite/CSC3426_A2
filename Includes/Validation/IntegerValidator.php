<?php

require_once("IFieldValidator.php");

class IntegerValidator implements IFieldValidator
{
    public function ValidateField($value, $args = true)
    {
        $message = "Value must be an integer";

        if (is_array($args) && isset($args["message"]))
        {
            $message = $args["message"];
        }

        if (!isset($value) || (is_bool($args) && $args === false))
        {
            return true;
        }

        if (!$this->IsInt($value))
        {
            return $message;
        }

        return true;
    }

    public function GetName() : string
    {
        return "integer";
    }

    private function IsInt($value) : bool
    {
        return filter_var($value, FILTER_VALIDATE_INT);
        //return ctype_digit(strval($value));
    }
}

?>