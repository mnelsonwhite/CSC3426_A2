<?php

class Controller
{
    // Take user request and load appropriate view file
    public function Request($request)
    {
        // Default the view to 'Default'
        $viewName = $request["Query"]["view"] ?? "Default";
        // Action is optional
        $actionName = $request["Query"]["action"] ?? null;
        $requestMethod = strtolower($request["Method"]);

        $viewfile = isset($actionName)
            ? "Views/$viewName.$actionName.$requestMethod.php"
            : "Views/$viewName.$requestMethod.php";
        
        include("Views/Layout.php");
    }
}

?>