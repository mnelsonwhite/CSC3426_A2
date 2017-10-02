<?php

require_once("Models/GameEntity.php");

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
        $this->View(null);
    }

    public function Add_Post()
    {
        $entity = $this->MapEntity(new GameEntity(), $this->request["Body"]);
        $dbContext = $this->request["DbContext"];
        $entity->Id = $dbContext->Create($entity);
        $this->View($entity);
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

abstract class ControllerBase
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function MapEntity($entity, $data)
    {
        foreach($entity as $key=>$value)
        {
            if (isset($data[$key])) {
                $entity->$key = $data[$key];    
            }
        }

        return $entity;
    }

    public function View($model, $view = null, $area = null)
    {
        $area = $area ?? $this->request["Query"]["area"];
        $view = $view ?? $this->request["Query"]["view"];
        $method = $this->request["Method"];
        
        $viewfile = "Views";
        
        if (isset($area))
        {
            $viewfile = "$viewfile/$area";
        }

        $viewfile = "$viewfile/$view.$method.php";
        
        include("Views/Layout.php");
    }
}

?>