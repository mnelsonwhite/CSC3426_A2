<?php

class EntityValidator
{
    private $dbSchema;

    public function __construct($dbSchema)
    {
        $this->dbSchema = $dbSchema;
    }

    public function IsValid($model) : bool
    {

        return false;
    }

    public function IsFieldDataTypeCorrect($model, $fieldName, $type)
    {
        switch($type)
        {
            case "TEXT":
                return !isset($model->$fieldName) || is_string($model->$fieldName);
            break;
            case "INTEGER":
                return !isset($model->$fieldName) || $this->is_int($model->$fieldName);
            break;
            default:
                throw new Exception("Unsupported data type");
        }
    }

    // true on string or numeric integer value
    private function is_int($input){
        return(ctype_digit(strval($input)));
    }
}

?>