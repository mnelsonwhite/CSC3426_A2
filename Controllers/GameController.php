<?php

require_once("Models/GameEntity.php");
require_once("Includes/ControllerBase.php");

class GameController extends ControllerBase
{
    public function Index_Get()
    {
        $dbContext = $this->request["DbContext"];
        $games = $dbContext->ReadAll("GameEntity");
        $this->View($games);
    }

    public function Add_Get()
    {
        $this->View(new GameEntity());
    }

    public function Add_Post()
    {
        $validationModel = [
            "TeamAName" => [
                "required" => []
            ],
            "TeamBName" => [
                "required" => []
            ],
            "PoolName" => [
                "required" => []
            ],
            "ScoreA" => [
                "required" => [],
                "integer" => []
            ],
            "ScoreB" => [
                "required" => [],
                "integer" => []
            ],
            "Date" => [
                "required" => [],
                "date" => [
                    "format" => "Ymd"
                ]
            ]
        ];

        $entity = $this->MapEntity(new GameEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        if (count($validationResult) > 0)
        {
            return $this->View($entity, ["validation" => $validationResult], ["view" => "add", "method" => "get"]);
        }

        $dbContext = $this->request["DbContext"];
        $entity->Id = $dbContext->Create($entity);
        
        return $this->View($entity);
    }

    public function Delete_Get()
    {
        $entity = new GameEntity();
        $entity->Id = $this->request["Query"]["id"];
        $dbContext = $this->request["DbContext"];
        $entity = $dbContext->Read($entity);
        $this->View($entity);
    }

    public function Delete_Post()
    {
        $entity = new GameEntity();
        $entity->Id = $this->request["Query"]["id"];
        $dbContext = $this->request["DbContext"];
        $dbContext->Delete($entity);
        $this->View($entity);
    }

    public function Edit_Get()
    {
        $entity = new GameEntity();
        $entity->Id = $this->request["Query"]["id"];
        $dbContext = $this->request["DbContext"];
        $entity = $dbContext->Read($entity);
        $this->View($entity);
    }

    public function Edit_Post()
    {
        $entity = $this->MapEntity(new GameEntity(), $this->request["Body"]);
        $dbContext = $this->request["DbContext"];
        $dbContext->Update($entity);
        $this->View($entity);
    }
}

?>