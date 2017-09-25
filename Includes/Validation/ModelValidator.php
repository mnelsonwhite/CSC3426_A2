<?php

require_once("IModelValidator.php");
require_once("IFieldValidator.php");

class ModelValidator implements IModelValidator
{
    private $validators;

    public function __construct(array $validators)
    {
        $this->validators = $validators ?? [];
    }

    public function AddFieldValidator(
        IFieldValidator $validator) : void
    {
        $this->validators[$validator->GetName()] = $validator;
    }

    public function Validate(
        object $entityModel,
        array $validationModel) : array
    {
        $result = [];
        // each property of entitymodel
        foreach($entityModel as $fieldName => $value)
        {
            $validations = $validationModel[$fieldName];

            if (isset($validations))
            {
                $result[$fieldName] = $this->ValidateField($validations, $value);
            }
        }

        return $result;
    }

    private function ValidateField(array $validations, $value) : array
    {
        $result = [];
        foreach ($validations as $name => $args)
        {
            $validator =$this->validators[$name]; 
            if (isset($validator))
            {
                $result[] = $validator->ValidateField($value, $args);
            }
        }

        return $result;
    }
}

?>