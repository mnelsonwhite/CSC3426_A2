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
        "admin" => "57aa393bc3b6970bad38e438ceda7c43d7f8e97a7945ce13f8e98fe736e12179"
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