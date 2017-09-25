<?php

interface IModelValidator
{
    public function AddFieldValidator(
        IFieldValidator $validator) : void;
    public function Validate(
        object $entityModel,
        array $validationModel) : array;
}

?>