<?php

interface IAuthenticationManager
{
    public function IsAuthenticated() : bool;
    public function UserName() : string;
}

class AuthenticationManager implements IAuthenticationManager
{
    private $server;
    
    // user, password hash dictionary
    private $users = [
        "admin" => "3b18a760e3f84432a5ee9b1fd70e8ce83371ae94d2b3e27374fa5633c02dad54"
    ];
    public function __construct($server)
    {
        $this->server = $server;
    }

    public function IsAuthenticated() : bool
    {
        $user = strtolower($this->server['PHP_AUTH_USER'] ?? "");

        // create password hash with username salt
        $passwordHash = hash("sha256", $user.($this->server['PHP_AUTH_PW'] ?? null));
        $hasValidUser = array_key_exists($user, $this->users);
        
        if(!$hasValidUser) return false;

        return $this->users[$user] === $passwordHash;
    }

    public function UserName() : string 
    {
        return $this->server['PHP_AUTH_USER'] ?? null;
    }
}
?>