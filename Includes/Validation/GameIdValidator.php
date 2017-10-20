<?php

require_once("FieldValidatorBase.php");
require_once("Includes/ICrudRepository.php");
require_once("Models/GameEntity.php");

// Validate the value as an existing game entity ID
class GameIdValidator extends FieldValidatorBase
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
        return "isGameId";
    }

    public function GetDefaultMessage() : string
    {
        return "Value must be a valid Game ID";
    }

    private function IsValidGameId($value)
    {
        $entity = new GameEntity();
        $entity->Id = $value;

        $result = $this->dbContext->Read($entity);

        return $result !== null;
    }
}

?>