<?php

require_once("Includes/Validation/IModelValidator.php");

abstract class ControllerBase
{
    public $request;
    public $validator;
    public $baseUrl;

    public function __construct(array $request, IModelValidator $validator, string $baseUrl)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->baseUrl = $baseUrl;
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

    public function NotFound($message)
    {
        http_response_code(404);
        include("Views/NotFound.php");
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

    public function Url($data)
    {
        $data["area"] = $data["area"] ?? $this->request["Query"]["area"];
        $data["view"] = $data["view"] ?? $this->request["Query"]["view"];;
        $url = $this->baseUrl."?".http_build_query($data, '', '&amp;');
        return $url;
    }
}

?>