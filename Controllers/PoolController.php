<?php

require_once("Models/PoolEntity.php");
require_once("Includes/ControllerBase.php");

class PoolController extends ControllerBase
{
    public function Initialise()
    {
        $this->title = "Pools";
    }

    public function Index_Get()
    {
        $dbContext = $this->request["DbContext"];
        $entities = $dbContext->ReadAll("PoolEntity");
        $this->View($entities);
    }

    public function Add_Get()
    {
        $this->RequireAuthentication();
        $this->View(new PoolEntity());
    }

    public function Add_Post()
    {
        $this->RequireAuthentication();

        $validationModel = [
            "Length" => [
                "required" => [],
                "integer" => []
            ],
            "Address" => [
                "required" => []
            ]
        ];

        $entity = $this->MapEntity(new PoolEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        if (count($validationResult) > 0)
        {
            return $this->View($entity, ["validation" => $validationResult], ["view" => "add", "method" => "get"]);
        }

        $dbContext = $this->request["DbContext"];
        $entity->Name = $dbContext->Create($entity);
        
        return $this->View($entity);
    }

    public function Delete_Get()
    {
        $this->RequireAuthentication();

        $validationModel = [
            "Name" => [
                "isPoolId" => [],
                "required" => []
            ]
        ];

        $entity = new PoolEntity();
        $entity->Name = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Pool with name '$entity->Name' not found");
        }

        $dbContext = $this->request["DbContext"];
        $entity = $dbContext->Read($entity);
        $this->View($entity);
    }

    public function Delete_Post()
    {
        $this->RequireAuthentication();

        $validationModel = [
            "Name" => [
                "isPoolId" => [],
                "required" => []
            ]
        ];
        $entity = new PoolEntity();
        $entity->Name = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Pool with name '$entity->Name' not found");
        }

        $dbContext = $this->request["DbContext"];
        $dbContext->Delete($entity);
        $this->View($entity);
    }

    public function Update_Get()
    {
        $this->RequireAuthentication();

        $validationModel = [
            "Name" => [
                "isPoolId" => [],
                "required" => []
            ]
        ];
        $entity = new PoolEntity();
        $entity->Name = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Pool with name '$entity->Name' not found");
        }

        $dbContext = $this->request["DbContext"];
        $entity = $dbContext->Read($entity);
        $this->View($entity);
    }

    public function Update_Post()
    {
        $this->RequireAuthentication();
        
        $validationModel = [
            "Name" => [
                "isPoolId" => [],
                "required" => []
            ],
            "Length" => [
                "required" => [],
                "integer" => []
            ],
            "Address" => [
                "required" => []
            ]
        ];

        $entity = $this->MapEntity(new PoolEntity(), $this->request["Body"]);
        $validationResult = $this->validator->Validate($entity, $validationModel);

        if (count($validationResult) > 0)
        {
            return $this->View($entity, ["validation" => $validationResult], ["view" => "update", "method" => "get"]);
        }

        $dbContext = $this->request["DbContext"];
        $dbContext->Update($entity);
        
        return $this->View($entity);
    }

    public function Detail_Get()
    {
        $validationModel = [
            "Id" => [
                "isPoolId" => [],
                "required" => []
            ],
        ];
        $entity = new PoolEntity();
        $entity->Name = $this->request["Query"]["id"];

        $validationResult = $this->validator->Validate($entity, $validationModel);
        
        if (count($validationResult) > 0)
        {
            return $this->NotFound("Pool with name '$entity->Name' not found");
        }

        $dbContext = $this->request["DbContext"];
        $dbContext->Read($entity);
        $this->View($entity);
    }
}

?>