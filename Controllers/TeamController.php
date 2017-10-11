<?php

require_once("Models/TeamEntity.php");
require_once("Includes/ControllerBase.php");

class TeamController extends ControllerBase
{
    public function Initialise()
    {
        $this->title = "Teams";
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
        $entities = $dbContext->ReadAll("TeamEntity");
        $this->View($entities);
    }

    public function Add_Get()
    {
        $viewbag = [
            "Pools" => $this->GetPools()
        ];
        $this->View(new TeamEntity(), $viewbag);
    }

    public function Add_Post()
    {
        $validationModel = [
            "Name" => [
                "required" => []
            ],
            "PoolName" => [
                "required" => [],
                "isPoolId" => []
            ],
            "Manager" => [
                "required" => []
            ]
        ];

        $entity = $this->MapEntity(new TeamEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        if (count($validationResult) > 0)
        {
            $viewbag = [
                "Pools" => $this->GetPools(),
                "validation" => $validationResult
            ];
            return $this->View($entity, $viewbag, ["view" => "add", "method" => "get"]);
        }

        $dbContext = $this->request["DbContext"];
        $entity->Name = $dbContext->Create($entity);
        
        return $this->View($entity);
    }

    public function Delete_Get()
    {
        $validationModel = [
            "Name" => [
                "isTeamId" => [],
                "required" => []
            ]
        ];

        $entity = new TeamEntity();
        $entity->Name = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Team with name '$entity->Name' not found");
        }

        $dbContext = $this->request["DbContext"];
        $entity = $dbContext->Read($entity);
        $this->View($entity);
    }

    public function Delete_Post()
    {
        $validationModel = [
            "Name" => [
                "isTeamId" => [],
                "required" => []
            ]
        ];
        $entity = new TeamEntity();
        $entity->Name = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Team with name '$entity->Name' not found");
        }

        $dbContext = $this->request["DbContext"];
        $dbContext->Delete($entity);
        $this->View($entity);
    }

    public function Update_Get()
    {
        $validationModel = [
            "Name" => [
                "isTeamId" => [],
                "required" => []
            ]
        ];

        $viewbag = [
            "Pools" => $this->GetPools()
        ];
        $entity = new TeamEntity();
        $entity->Name = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Team with name '$entity->Name' not found");
        }

        $dbContext = $this->request["DbContext"];
        $entity = $dbContext->Read($entity);
        $this->View($entity, $viewbag);
    }

    public function Update_Post()
    {
        $validationModel = [
            "Name" => [
                "required" => [],
                "isTeamId" => []
            ],
            "PoolName" => [
                "required" => [],
                "isPoolId" => []
            ],
            "Manager" => [
                "required" => []
            ]
        ];

        $entity = $this->MapEntity(new TeamEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        if (count($validationResult) > 0)
        {
            $viewbag = [
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
                "isTeamId" => [],
                "required" => []
            ],
        ];
        $entity = new TeamEntity();
        $entity->Name = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Team with name '$entity->Name' not found");
        }

        $dbContext = $this->request["DbContext"];
        $dbContext->Read($entity);
        $this->View($entity);
    }
}

?>