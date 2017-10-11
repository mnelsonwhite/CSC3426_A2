<?php

require_once("Models/GameEntity.php");
require_once("Includes/ControllerBase.php");

class GameController extends ControllerBase
{
    public function Initialise()
    {
        $this->title = "Games";
    }

    private function GetTeams()
    {
        $dbContext = $this->request["DbContext"];
        $teams = [];
        foreach($dbContext->ReadAll("TeamEntity") as $team)
        {
            $teams[$team->Name] = $team->Name;
        }

        return $teams;
    }

    private function GetPools()
    {
        $dbContext = $this->request["DbContext"];
        $pools = [];
        foreach($dbContext->ReadAll("PoolEntity") as $pool)
        {
            $pools[$pool->Name] = $pool->Name;
        }

        return $pools;

    }

    public function Index_Get()
    {
        $dbContext = $this->request["DbContext"];
        $entities = $dbContext->ReadAll("GameEntity");
        $this->View($entities);
    }

    public function Add_Get()
    {
        $viewbag = [
            "Teams" => $this->GetTeams(),
            "Pools" => $this->GetPools()
        ];

        $this->View(new GameEntity(), $viewbag);
    }

    public function Add_Post()
    {
        $validationModel = [
            "TeamAName" => [
                "isTeamId" => [],
                "required" => []
            ],
            "TeamBName" => [
                "isTeamId" => [],
                "required" => []
            ],
            "PoolName" => [
                "required" => [],
                "isPoolId" => []
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
                ],
                "length" => [
                    "eq" => 8
                ],
                "message" => "Must be 8 characters"
            ]
        ];

        $entity = $this->MapEntity(new GameEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        if (count($validationResult) > 0)
        {
            $viewbag = [
                "Teams" => $this->GetTeams(),
                "Pools" => $this->GetPools(),
                "validation" => $validationResult
            ];

            return $this->View($entity, $viewbag, ["view" => "add", "method" => "get"]);
        }

        $dbContext = $this->request["DbContext"];
        $entity->Id = $dbContext->Create($entity);
        
        return $this->View($entity);
    }

    public function Delete_Get()
    {
        $validationModel = [
            "Id" => [
                "isGameId" => [],
                "required" => [],
                "integer" => []
            ],
        ];

        $entity = new GameEntity();
        $entity->Id = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Game with ID '$entity->Id' not found");
        }

        $dbContext = $this->request["DbContext"];
        $entity = $dbContext->Read($entity);
        $this->View($entity);
    }

    public function Delete_Post()
    {
        $validationModel = [
            "Id" => [
                "isGameId" => [],
                "required" => [],
                "integer" => []
            ],
        ];
        $entity = new GameEntity();
        $entity->Id = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Game with ID '$entity->Id' not found");
        }

        $dbContext = $this->request["DbContext"];
        $dbContext->Delete($entity);
        $this->View($entity);
    }

    public function Update_Get()
    {
        $validationModel = [
            "Id" => [
                "isGameId" => [],
                "required" => [],
                "integer" => []
            ],
        ];
        $entity = new GameEntity();
        $entity->Id = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Game with ID '$entity->Id' not found");
        }

        $viewbag = [
            "Teams" => $this->GetTeams(),
            "Pools" => $this->GetPools()
        ];

        $dbContext = $this->request["DbContext"];
        $entity = $dbContext->Read($entity);
        $this->View($entity, $viewbag);
    }

    public function Update_Post()
    {
        $validationModel = [
            "Id" => [
                "isGameId" => [],
                "required" => [],
                "integer" => []
            ],
            "TeamAName" => [
                "isTeamId" => [],
                "required" => []
            ],
            "TeamBName" => [
                "isTeamId" => [],
                "required" => []
            ],
            "PoolName" => [
                "required" => [],
                "isPoolId" => []
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
                ],
                "length" => [
                    "eq" => 8,
                    "message" => "Must be 8 characters"
                ],   
            ]
        ];

        $entity = $this->MapEntity(new GameEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        if (count($validationResult) > 0)
        {
            $viewbag = [
                "Teams" => $this->GetTeams(),
                "Pools" => $this->GetPools(),
                "validation" => $validationResult
            ];

            return $this->View($entity, $viewbag, ["view" => "update", "method" => "get"]);
        }

        $dbContext = $this->request["DbContext"];
        $dbContext->Update($entity);
        
        return $this->View($entity);
    }

    public function Detail_Get()
    {
        $validationModel = [
            "Id" => [
                "isGameId" => [],
                "required" => [],
                "integer" => []
            ],
        ];
        $entity = new GameEntity();
        $entity->Id = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Game with ID '$entity->Id' not found");
        }

        $dbContext = $this->request["DbContext"];
        $dbContext->Read($entity);
        $this->View($entity);
    }
}

?>