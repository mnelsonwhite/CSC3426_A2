<?php

require_once("CsvHandler.php");
require_once("Models/TeamEntity.php");
require_once("Models/PlayerEntity.php");
require_once("Models/PoolEntity.php");
require_once("Models/GameEntity.php");

class WaterPoloSeedService
{
    private $repository;
    private $dbSchema;
    private $gamesCsvPath;
    private $teamsCsvPath;
    private $csvHandler;

    public function __construct(
        ICrudRepository $repository,
        $dbSchema,
        $gamesCsvPath,
        $teamsCsvPath)
    {
        $this->repository = $repository;
        $this->dbSchema = $dbSchema;
        $this->gamesCsvPath = $gamesCsvPath;
        $this->teamsCsvPath = $teamsCsvPath;
        $this->csvHandler = new CsvHandler();
    }

    public function Seed()
    {
        $csvData = $this->GetCsvData();
        $seedData = [
            "teams" => $this->GetTeams($csvData["teams"]),
            "players" => $this->GetPlayers($csvData["teams"]),
            "pools" => $this->GetPools($csvData["teams"]),
            "games" => $this->GetGames($csvData["games"])
        ];

        $resolver = new DependencyGraphResolver();
        $dependencyOrder = $resolver->GetDependencyOrder($this->dbSchema);

        foreach($dependencyOrder as $tableName)
        {
            foreach($seedData[$tableName] as $entity)
            {
                $this->repository->Create($entity);
            }
        }
    }

    private function GetCsvData()
    {
        $csvData = [
            "games" => $this->csvHandler->GetAllRecords($this->gamesCsvPath),
            "teams" => $this->csvHandler->GetAllRecords($this->teamsCsvPath)
        ];

        // Remove headers
        unset($csvData["games"][0]);
        unset($csvData["teams"][0]);

        return $csvData;
    }

    // 0 - Name
    // 1 - Manager
    // 6 - PoolName
    private function GetTeams($data)
    {
        $teams = [];

        foreach($data as $row)
        {
            if(!isset($teams[$row[0]]))
            {
                $entity = new TeamEntity();
                $entity->Name = $row[0];
                $entity->Manager = $row[1];
                $entity->PoolName = $row[6];
                $teams[$row[0]] = $entity;
            }
        }

        return $teams;
    }

    private function GetPlayers($data)
    {
        $players = [];
        
        foreach($data as $row)
        {
            $key = $row[4].$row[2].$row[3];
            if(!isset($players[$key]))
            {
                $entity = new PlayerEntity();
                $entity->TeamName = $row[0];
                $entity->Handed = $row[5];
                $entity->GivenName = $row[2];
                $entity->FamilyName = $row[3];
                $entity->Dob = $row[4];
                $players[$key] = $entity;
            }
        }
        
        return $players;
    }

    private function GetPools($data)
    {
        $pools = [];
        
        foreach($data as $row)
        {
            $key = $row[6];
            if(!isset($pools[$key]))
            {
                $entity = new PoolEntity();
                $entity->Name = $row[6];
                $entity->Length = $row[7];
                $entity->Address = $row[8];
                $pools[$key] = $entity;
            }
        }
        
        return $pools;
    }

    private function GetGames($data)
    {
        $games = [];
        
        foreach($data as $row)
        {
            $key = $row[0].$row[2].$row[6];
            if(!isset($games[$key]))
            {
                $entity = new GameEntity();
                $entity->Date = $row[6];
                $entity->PoolName = $row[4];
                $entity->TeamAName = $row[0];
                $entity->ScoreA = $row[1];
                $entity->TeamBName = $row[2];
                $entity->ScoreB = $row[3];
                $games[$key] = $entity;
            }
        }
        
        return $games;
    }
}

?>