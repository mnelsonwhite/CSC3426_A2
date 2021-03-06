<?php

require_once("ICrudRepository.php");
require_once("DbContext.php");
require_once("WaterHockeySeedService.php");
require_once("Controllers/GameController.php");
require_once("Controllers/PlayerController.php");
require_once("Controllers/PoolController.php");
require_once("Controllers/TeamController.php");
require_once("Controllers/HomeController.php");

require_once("Includes/Validation/IModelValidator.php");
require_once("Includes/Validation/ModelValidator.php");
require_once("Includes/Validation/DateValidator.php");
require_once("Includes/Validation/IntegerValidator.php");
require_once("Includes/Validation/RequiredValidator.php");
require_once("Includes/Validation/GameIdValidator.php");
require_once("Includes/Validation/TeamIdValidator.php");
require_once("Includes/Validation/PoolIdValidator.php");
require_once("Includes/Validation/PlayerIdValidator.php");
require_once("Includes/Validation/HandedValidator.php");
require_once("Includes/Validation/LengthValidator.php");


class RequestHandler
{
    // map for area names and controllers
    private $controllers = [
        "game" => "GameController",
        "home" => "HomeController",
        "player" => "PlayerController",
        "pool" => "PoolController",
        "team" => "TeamController"
    ];

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

        // Prepare object to seed database from CSV files
        $seedService = new WaterHockeySeedService(
            $dbContext,
            $dbSchema,
            $ApplicationConfig["GAMESCSV_PATH"],
            $ApplicationConfig["TEAMSCSV_PATH"]);

        // Create and seed database if the database file does not exist
        if ($ApplicationConfig["DB_PATH"] === ":memory:"
            || !file_exists($ApplicationConfig["DB_PATH"]))
        {
            error_log("Seeding database");
            $dbContext->Initialize();
            $seedService->Seed();
        }
        
        // Build request context
        $request = [
            "Query" => $_REQUEST ?? [],
            "Body" => $_BODY ?? [],
            "Method" => strtolower($_SERVER["REQUEST_METHOD"] ?? "get"),
            "DbContext" => $dbContext,
            "BaseUrl" => $ApplicationConfig["BASE_URL"]
        ];

        // construct authentication manager
        $authManager = new AuthenticationManager($_SERVER);

        // default views and areas
        $request["Query"]["view"] = strtolower($request["Query"]["view"] ?? "Index");
        $request["Query"]["area"] = strtolower($request["Query"]["area"] ?? "home");

        // Find controller for area
        $controllerName = $this->controllers[$request["Query"]["area"]] ?? null;

        // If cannot find controller registration NOT FOUND
        if ($controllerName == null)
        {
            $message = "Area '".$request["Query"]["area"]."' is not registered";
            $this->NotFound($message);
        }

        $controllerMethods = get_class_methods($controllerName);

        $findMethod = strtolower($request["Query"]["view"]."_".$request["Method"]);
        foreach($controllerMethods as $methodName)
        {
            // Init controller when method found
            if ($findMethod === strtolower($methodName))
            {
                $this->InitController(
                    $request,
                    $controllerName,
                    $methodName,
                    $authManager);
                die();
            }
        }
        // If no controller method found then NOT FOUND
        $message = "View '".$request["Query"]["view"]
            ."' for method '".$request["Method"]
            ."' cannot be found in controller.";
            
        $this->NotFound($message);
    }

    private function InitController(
        $request,
        $controllerName,
        $methodName,
        $authManager)
    {
        $controller = new $controllerName(
            $request,
            $this->InitValidator($request["DbContext"]),
            $request["BaseUrl"],
            $authManager);
        $controller->$methodName(); 
    }

    private function NotFound($message)
    {
        http_response_code(404);
        include("Views/NotFound.php");
        die();
    }

    private function InitValidator(ICrudRepository $dbContext) : IModelValidator
    {
        $fieldValidators = [
            new DateValidator(),
            new IntegerValidator(),
            new RequiredValidator(),
            new HandedValidator(),
            new LengthValidator(),
            new GameIdValidator($dbContext),
            new TeamIdValidator($dbContext),
            new PoolIdValidator($dbContext),
            new PlayerIdValidator($dbContext)
        ];
        $modelValidator = new ModelValidator($fieldValidators);

        return $modelValidator;
    }
}

?>