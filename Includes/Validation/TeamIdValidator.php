<?php

require_once("FieldValidatorBase.php");
require_once("Includes/ICrudRepository.php");
require_once("Models/TeamEntity.php");

// Validate the value as an existing team entity ID
class TeamIdValidator extends FieldValidatorBase
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
        return "isTeamId";
    }

    public function GetDefaultMessage() : string
    {
        return "Value must be a valid Team name";
    }

    private function IsValidGameId($value)
    {
        $entity = new TeamEntity();
        $entity->Name = $value;

        $result = $this->dbContext->Read($entity);

        return $result !== null;
    }
}

?>