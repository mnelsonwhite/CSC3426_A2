<?php

require_once("Models/PlayerEntity.php");
require_once("Includes/ControllerBase.php");

class PlayerController extends ControllerBase
{
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

    public function Index_Get()
    {
        $dbContext = $this->request["DbContext"];
        $entities = $dbContext->ReadAll("PlayerEntity");

        $this->View($entities);
    }

    public function Add_Get()
    {
        $viewbag = [
            "Teams" => $this->GetTeams()
        ];

        $this->View(new PlayerEntity(), $viewbag);
    }

    public function Add_Post()
    {
        $validationModel = [
            "TeamName" => [
                "isTeamId" => [],
                "required" => []
            ],
            "GivenName" => [
                "required" => []
            ],
            "FamilyName" => [
                "required" => []
            ],
            "Dob" => [
                "required" => [],
                "date" => [
                    "format" => "Ymd"
                ]
            ],
            "Handed" => [
                "required" => [],
                "hand" => []
            ]
        ];

        $entity = $this->MapEntity(new PlayerEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        if (count($validationResult) > 0)
        {
            $viewbag = [
                "Teams" => $this->GetTeams(),
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
                "isPlayerId" => [],
                "required" => [],
                "integer" => []
            ],
        ];

        $entity = new PlayerEntity();
        $entity->Id = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Player with ID '$entity->Id' not found");
        }

        $dbContext = $this->request["DbContext"];
        $entity = $dbContext->Read($entity);
        $this->View($entity);
    }

    public function Delete_Post()
    {
        $validationModel = [
            "Id" => [
                "isPlayerId" => [],
                "required" => [],
                "integer" => []
            ],
        ];
        $entity = new PlayerEntity();
        $entity->Id = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Player with ID '$entity->Id' not found");
        }

        $dbContext = $this->request["DbContext"];
        $dbContext->Delete($entity);
        $this->View($entity);
    }

    public function Update_Get()
    {
        $validationModel = [
            "Id" => [
                "isPlayerId" => [],
                "required" => [],
                "integer" => []
            ],
        ];
        $entity = new PlayerEntity();
        $entity->Id = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Player with ID '$entity->Id' not found");
        }

        $viewbag = [
            "Teams" => $this->GetTeams()
        ];

        $dbContext = $this->request["DbContext"];
        $entity = $dbContext->Read($entity);
        $this->View($entity, $viewbag);
    }

    public function Update_Post()
    {
        $validationModel = [
            "Id" => [
                "isPlayerId" => [],
                "required" => [],
                "integer" => []
            ],
            "TeamName" => [
                "isTeamId" => [],
                "required" => []
            ],
            "GivenName" => [
                "required" => []
            ],
            "FamilyName" => [
                "required" => []
            ],
            "Dob" => [
                "required" => [],
                "date" => [
                    "format" => "Ymd"
                ]
            ],
            "Handed" => [
                "required" => [],
                "hand" => []
            ]
        ];

        $entity = $this->MapEntity(new PlayerEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        if (count($validationResult) > 0)
        {
            $viewbag = [
                "Teams" => $this->GetTeams(),
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
                "isPlayerId" => [],
                "required" => [],
                "integer" => []
            ],
        ];
        $entity = new PlayerEntity();
        $entity->Id = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Player with ID '$entity->Id' not found");
        }

        $dbContext = $this->request["DbContext"];
        $dbContext->Read($entity);
        $this->View($entity);
    }
}

?>