<?php

require_once("FieldValidatorBase.php");

class DateValidator extends FieldValidatorBase
{
    public function IsValid($value, array $args) : bool
    {
        if (is_string($value))
        {
            $format = $args["format"] ?? "Y-m-d";

            // Possible race condition
            // Last errors are required since 2001-01-99 is parsed as a valid date (gg php)
            $isDate = is_a(DateTime::createFromFormat($format, $value), "DateTime");
            $errors = DateTime::getLastErrors();
            return $isDate && !empty($errors) && $errors["warning_count"] === 0;
        }
        else if (is_a($value, "DateTime"))
        {
            return true;
        }

        return false;
    }

    public function GetName() : string
    {
        return "required";
    }

    public function GetDefaultMessage() : string
    {
        return "Must be a valid date";
    }
}

?>