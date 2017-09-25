<?php

interface IModelValidator
{
    public function AddFieldValidator(
        string $name,
        IFieldValidator $validator) : void;
    public function Validate(
        object $entityModel,
        array $validationModel) : array;
}

?>