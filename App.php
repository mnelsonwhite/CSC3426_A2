<?php
require_once("includes/GameEntity.php");
require_once("includes/PoolEntity.php");
require_once("includes/DbContext.php");

function FormatString($string, $args)
{
    $result = (string) $string;

    foreach($args as $key=>$value)
    {
        $pattern = "/\\{".$key."\\}/";
        if(preg_match_all($pattern, $string, $matches) == 1)
        {
            $result = preg_replace($pattern, $value, $result);
        }
        else
        {
            throw new Exception("FormatString expects only one instance of key");
        }
    }

    return $result;
}

$ApplicationConfig = parse_ini_file("Config.ini");
$dbContext = new DbContext(
    $ApplicationConfig["DB_PATH"],
    $ApplicationConfig["DB_SCHEMA_PATH"]);

$pool = new PoolEntity();
$pool->Name = "PoolA";
$pool->Address = "123 Fake Street";
$pool->Length = 50;

$dbContext->Create($pool);
$pool = new PoolEntity();
$pool->Name = "PoolA";
$pool->Length = 25;
$dbContext->Update($pool);

$pool = new PoolEntity();
$pool->Name = "PoolA";

$pool = $dbContext->Read($pool);

print_r($pool);



// $result = $dbContext->Games()->Read($id);
// print_r($result);

// $player = new PlayerEntity();
// $player->GivenName = "Test";
// $player->FamilyName = "McTestface";
// $player->TeamName = "The Shit Sticks";
// $player->Dob = "2017-01-01";
// $player->Handed = "Right";
// $id = $dbContext->Players()->Create($player);
// $result = $dbContext->Players()->Read($id);
// print_r($result);

// $pool = new PoolEntity();
// $pool->Name = "PoolA";
// $pool->Length = 50;
// $pool->Address = "123 Fake Street";
// $id = $dbContext->Pools()->Create($pool);
// $result = $dbContext->Pools()->Read($id);
// print_r($result);

// $team = new TeamEntity();
// $team->Manager = "Billy Bob";
// $team->Name = "The Shit Sticks";
// $team->PoolName = "PoolA";
// $id = $dbContext->Teams()->Create($team);
// $dbContext->Teams()->Delete($id);
// $result = $dbContext->Teams()->Read($id);
// print_r($result);

//$dbContext->Players()->Update($player);
?>