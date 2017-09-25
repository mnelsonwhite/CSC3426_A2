<?php

interface IFieldValidator
{
    public function ValidateField($value, $args);
    public function GetName() : string;
}

?>