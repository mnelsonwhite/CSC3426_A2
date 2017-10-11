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

    public function Login_Get()
    {
        $this->RequireAuthentication();
        return $this->View(null, null, ["view" => "index"]);
    }

    public function Logout_Get()
    {

    }
}

?>