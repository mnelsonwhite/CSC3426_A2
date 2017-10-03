<?php

interface IModelValidator
{
    public function AddFieldValidator(
        IFieldValidator $validator) : void;
    public function Validate(
        $entityModel,
        array $validationModel) : array;
}

?>