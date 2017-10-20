<?php

require_once("Includes/ControllerBase.php");

class HomeController extends ControllerBase
{
    public function Initialise()
    {
        $this->title = "Home";
    }

    public function Index_Get()
    {
        // Redirect to the team index
        $this->Redirect(["area"=> "team"]);
    }
}

?>