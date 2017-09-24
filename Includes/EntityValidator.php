<?php

class EntityValidator
{
    private $dbSchema;

    public function __construct($dbSchema)
    {
        $this->dbSchema = $dbSchema;
    }

    public function IsValid($model, $validationModel) : bool
    {

        return false;
    }
}

?>