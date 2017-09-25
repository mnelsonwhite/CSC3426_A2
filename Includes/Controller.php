<?php

class Controller
{
    // Take user request and load appropriate view file
    public function Request($request)
    {
        // Default the view to 'Default'
        $viewName = $request["Query"]["view"] ?? "Default";
        // Action is optional
        $areaName = $request["Query"]["area"] ?? null;
        $requestMethod = strtolower($request["Method"]);

        $viewfile = "Views/";

        if (isset($areaName))
        {
            $viewfile = $viewfile."$areaName/";
        }

        $viewfile = $viewfile."$viewName.$requestMethod.php";
        
        include("Views/Layout.php");
    }
}

?>