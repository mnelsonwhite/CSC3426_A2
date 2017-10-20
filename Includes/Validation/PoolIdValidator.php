<?php

require_once("FieldValidatorBase.php");
require_once("Includes/ICrudRepository.php");
require_once("Models/PoolEntity.php");

// Validate the value as an existing pool entity ID
class PoolIdValidator extends FieldValidatorBase
{
    private $dbContext;

    public function __construct(ICrudRepository $dbContext)
    {
        $this->dbContext = $dbContext;
    }

    public function IsValid($value, array $args) : bool
    {
        return !isset($value) || $this->IsValidGameId($value);
    }

    public function GetName() : string
    {
        return "isPoolId";
    }

    public function GetDefaultMessage() : string
    {
        return "Value must be a valid Pool name";
    }

    private function IsValidGameId($value)
    {
        $entity = new PoolEntity();
        $entity->Name = $value;

        $result = $this->dbContext->Read($entity);

        return $result !== null;
    }
}

?>