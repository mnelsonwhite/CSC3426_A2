<?php

require_once("DbContext.php");
require_once("Controller.php");
require_once("WaterPoloSeedService.php");

class RequestHandler
{
    // Prepare applciation request context
    public function Start()
    {
        // get the protocol request body
        parse_str(file_get_contents("php://input"), $_BODY);
        
        // get application config
        $ApplicationConfig = parse_ini_file("Config.ini");
        
        // get database metadata and parse to PHP associative array
        $filedata = file_get_contents($ApplicationConfig["DB_SCHEMA_PATH"]);
        $dbSchema = json_decode($filedata, true);
        $dbContext = new DbContext($ApplicationConfig["DB_PATH"], $dbSchema);

        $controller = new Controller();

        // Prepare object to seed database from CSV files
        $seedService = new WaterPoloSeedService(
            $dbContext,
            $dbSchema,
            $ApplicationConfig["GAMESCSV_PATH"],
            $ApplicationConfig["TEAMSCSV_PATH"]);

        // Create and seed database if config variable is true
        if(($ApplicationConfig["SEED_DATABASE"] ?? "false") === "true")
        {
            error_log("Seeding database");
            $dbContext->Initialize();
            $seedService->Seed();
        }
        
        // Build request context
        $requestContext = [
            "Query" => $_REQUEST ?? [],
            "Body" => $_BODY ?? [],
            "Method" => $_SERVER["REQUEST_METHOD"] ?? "GET",
            "DbContext" => $dbContext
        ];
        
        // Process the request
        $controller->Request($requestContext);
    }
}

?>