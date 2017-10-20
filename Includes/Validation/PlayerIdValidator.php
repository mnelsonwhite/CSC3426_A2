<?php

require_once("FieldValidatorBase.php");
require_once("Includes/ICrudRepository.php");
require_once("Models/PlayerEntity.php");

// Validate the value as an existing player entity ID
class PlayerIdValidator extends FieldValidatorBase
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
        return "isPlayerId";
    }

    public function GetDefaultMessage() : string
    {
        return "Value must be a valid Player ID";
    }

    private function IsValidGameId($value)
    {
        $entity = new PlayerEntity();
        $entity->Id = $value;

        $result = $this->dbContext->Read($entity);

        return $result !== null;
    }
}

?>