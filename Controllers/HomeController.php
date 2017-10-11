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
        return $this->View(null);
    }
}

?>