<?php

require_once("Models/GameEntity.php");
require_once("Includes/ControllerBase.php");

// Game entity views
class GameController extends ControllerBase
{
    public function Initialise()
    {
        // Set page title for all views
        // in this controller
        $this->title = "Games";
    }

    // Get an array of teams for form select elements
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

    // Get an array of pool for form select elements
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

    // Get all game entities to view index
    public function Index_Get()
    {
        $dbContext = $this->request["DbContext"];
        $entities = $dbContext->ReadAll("GameEntity");
        $this->View($entities);
    }

    // View to create new game entity
    public function Create_Get()
    {
        $this->RequireAuthentication();

        $viewbag = [
            "Teams" => $this->GetTeams(),
            "Pools" => $this->GetPools()
        ];

        $this->View(new GameEntity(), $viewbag);
    }

    // Method to receive posted new game entity
    // validate and persist in database.
    // Will either display validation errors or
    // redirect to the index view
    public function Create_Post()
    {
        $this->RequireAuthentication();

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
                    "format" => "Y-m-d",
                    "message" => "Must be in yyyy-mm-dd format"
                ],
                "length" => [
                    "eq" => 10,
                    "message" => "Must be 10 characters yyyy-mm-dd"
                ],
                
            ]
        ];

        $entity = $this->MapEntity(new GameEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        // Do not allow both teams to be the same
        if ($entity->TeamAName == $entity->TeamBName)
        {
            $validationResult["TeamAName"][] = "Must be different from Team B Name";
            $validationResult["TeamBName"][] = "Must be different from Team A Name";
        }

        if (count($validationResult) > 0)
        {
            // put teams and pools into the viewbag
            // so that the create view can work
            $viewbag = [
                "Teams" => $this->GetTeams(),
                "Pools" => $this->GetPools(),
                "validation" => $validationResult
            ];

            return $this->View(
                $entity,
                $viewbag,
                ["view" => "create", "method" => "get"]);
        }

        $dbContext = $this->request["DbContext"];
        $entity->Id = $dbContext->Create($entity);
        
        $this->Redirect([
            "view" => "index",
            "method" => "get"]);
    }

    // View to delete a game entity
    public function Delete_Get()
    {
        $this->RequireAuthentication();

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

    // Method to delete posted game entity by ID
    public function Delete_Post()
    {
        $this->RequireAuthentication();

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
        
        $this->Redirect([
            "view" => "index",
            "method" => "get"]);
    }

    // View to update a game entity
    public function Update_Get()
    {
        $this->RequireAuthentication();

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

    // Method to update a game entity
    public function Update_Post()
    {
        $this->RequireAuthentication();
        
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
                    "format" => "Y-m-d",
                    "mesage" => "Must be in yyyy-mm-dd format"
                ],
                "length" => [
                    "eq" => 10,
                    "message" => "Must be 10 characters yyyy-mm-dd"
                ],   
            ]
        ];

        $entity = $this->MapEntity(new GameEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        if ($entity->TeamAName == $entity->TeamBName)
        {
            $validationResult["TeamAName"][] = "Must be different from Team B Name";
            $validationResult["TeamBName"][] = "Must be different from Team A Name";
        }

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
        
        $this->Redirect([
            "view" => "index",
            "method" => "get"]);
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