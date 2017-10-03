<?php

require_once("IModelValidator.php");
require_once("IFieldValidator.php");

class ModelValidator implements IModelValidator
{
    private $validators;

    public function __construct(array $validators)
    {
        $this->validators = [];
        $validators = $validators ?? [];
        foreach($validators as $validator)
        {
            $this->validators[$validator->GetName()] = $validator;
        }
    }

    public function AddFieldValidator(
        IFieldValidator $validator) : void
    {
        $this->validators[$validator->GetName()] = $validator;
    }

    public function Validate(
        $entityModel,
        array $validationModel) : array
    {
        $results = [];
        // each property of entitymodel
        foreach($entityModel as $fieldName => $value)
        {
            if (array_key_exists($fieldName, $validationModel))
            {
                $validations = $validationModel[$fieldName];
                $result = $this->ValidateField($validations, $value);
                if (count($result) > 0)
                {
                    $results[$fieldName] = $result;
                }
            }
        }

        return $results;
    }

    private function ValidateField(array $validations, $value) : array
    {
        $results = [];
        foreach ($validations as $name => $args)
        {
            
            if (array_key_exists($name, $this->validators))
            {
                $validator = $this->validators[$name];
                $result = $validator->ValidateField($value, $args);
                if ($result !== true)
                {
                    $results[] = $result;
                }
            }
        }

        return $results;
    }
}

?>