<?php

require_once("Includes/Validation/IModelValidator.php");

abstract class ControllerBase
{
    public $request;
    public $validator;

    public function __construct(array $request, IModelValidator $validator)
    {
        $this->request = $request;
        $this->validator = $validator;
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

    public function View($model, $viewbag = [], $route = [])
    {
        $area = $route["arear"] ?? $this->request["Query"]["area"];
        $view = $route["view"] ?? $this->request["Query"]["view"];
        $method = $route["method"] ?? $this->request["Method"];
        
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