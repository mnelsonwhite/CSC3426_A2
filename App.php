<?php
require_once("Models/GameEntity.php");
require_once("Models/PoolEntity.php");
require_once("Models/PlayerEntity.php");
require_once("Models/TeamEntity.php");
require_once("Includes/DbContext.php");

// function FormatString($string, $args)
// {
//     $result = (string) $string;

//     foreach($args as $key=>$value)
//     {
//         $pattern = "/\\{".$key."\\}/";
//         if(preg_match_all($pattern, $string, $matches) == 1)
//         {
//             $result = preg_replace($pattern, $value, $result);
//         }
//         else
//         {
//             throw new Exception("FormatString expects only one instance of key");
//         }
//     }

//     return $result;
// }

$ApplicationConfig = parse_ini_file("Config.ini");
$dbContext = new DbContext(
    $ApplicationConfig["DB_PATH"],
    $ApplicationConfig["DB_SCHEMA_PATH"]);

$entity = new PlayerEntity();
$entity->GivenName = "Test";

print_r($dbContext->ReadAll("PlayerEntity"));
?>