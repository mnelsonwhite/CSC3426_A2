<?php

class TeamEntity
{
    // Key
    public $Name;
    // Pool Foreign Key
    public $PoolName;
    public $Manager;

    // Related Entities
    public $Players;
    public $Pool;
    public $Games;
}

?>
