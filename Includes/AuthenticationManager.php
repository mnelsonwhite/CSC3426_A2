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
        "admin" => "28531336563e1f3883b87d858af447e561471bd7"
    ];
    public function __construct($server)
    {
        $this->server = $server;
    }

    public function IsAuthenticated() : bool
    {
        // $hasUser = isset($this->server['PHP_AUTH_USER']);
        // $hasPassword = isset($this->server['PHP_AUTH_PW']);
        
        // if (!($hasUser && $hasPassword)) return false;
        
        $user = strtolower($this->server['PHP_AUTH_USER'] ?? "");
        $password = sha1($this->server['PHP_AUTH_PW'] ?? null);
        $hasValidUser = array_key_exists($user, $this->users);
        
        if(!$hasValidUser) return false;

        return $this->users[$user] === $password;
    }

    public function UserName() : string 
    {
        return $this->server['PHP_AUTH_USER'] ?? null;
    }
}


?>