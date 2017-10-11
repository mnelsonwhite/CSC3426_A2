<?php

require_once("Includes/Validation/IModelValidator.php");
require_once("Includes/AuthenticationManager.php");

abstract class ControllerBase
{
    public $request;
    public $validator;
    public $baseUrl;
    public $title;

    private $authenticationManager;

    public function __construct(
        array $request,
        IModelValidator $validator,
        string $baseUrl,
        IAuthenticationManager $authenticationManager)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->baseUrl = $baseUrl;
        $this->title = "Web Page";
        $this->authenticationManager = $authenticationManager;
        $this->Initialise();
    }

    public abstract function Initialise();

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

    public function RequireAuthentication()
    {
        if (!$this->authenticationManager->IsAuthenticated())
        {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Authentication is REQUIRED';
            exit;
        }
    }
}

?>