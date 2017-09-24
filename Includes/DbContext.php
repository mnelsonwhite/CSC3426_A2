<?php

require_once("DbInitializer.php");
require_once("ICrudRepository.php");

class DbContext implements ICrudRepository
{
    private $dbPath;
    private $dbHandle;
    private $dbSchema;
    
    // SQLITE type mapping
    private $fieldTypeMap = [
        'TEXT' => SQLITE3_TEXT,
        'INTEGER' => SQLITE3_TEXT
    ];
    
    // @params:
    //  dbPath:     This is a string which represents the path to
    //              the SQLITE database file or ':memory:' for a
    //              _in memory_ database.
    //
    //  dbSchema:   An associative array which defines the struture
    //              of the database. The array has the following
    //              expected structure.
    //              It is assumed that each table only has 1 field
    //              the table key. 
    //
    //              [
    //                  "<table name>" => [
    //                      "fields" => [
    //                          "<field name>" => "<field type>"
    //                      ],
    //                      "key" => [
    //                          "<key field name>" => <is autoincrement>
    //                      ],
    //                      "fkey" => [
    //                          "<foreign key field name>" => "<related table>"
    //                      ],
    //                      "entityclass" => "<entity class name>"
    //                  ]
    //              ]
    public function __construct(
        $dbPath,
        $dbSchema)
    {
        $this->dbPath = $dbPath;
        $this->dbSchema = $dbSchema;
    }

    // Clean up dbhandle
    public function __dispose()
    {
        if (isset($this->dbHandle))
        {
            $this->dbHandle->close();
        }
    }

    // Lazy Init the db handle
    private function GetDbHandle()
    {
        if(!isset($this->dbHandle))
        {
            $this->dbHandle = new SQLite3($this->dbPath);
        }

        return $this->dbHandle;
    }
    
    // Create tables and foreign key relationships
    // in order of constraint dependency
    public function Initialize()
    {
        $init = new DbInitializer(
            $this->GetDbHandle(),
            $this->dbSchema);

        $init->Initialize();
    }

    // Find the table name related to the entity class name
    private function GetTableNameFromEntityType($entityType)
    {
        $schema = $this->dbSchema;

        foreach($schema as $key=>$value)
        {
            if ($value['entityclass'] == $entityType)
            {
                return $key;
            }
        }

        return null;
    }

    // @description
    //  Add new entity to database
    //
    // @params
    //  entity:         The enttiy with updated fields
    public function Create($entity)
    {
        $className = get_class($entity);
        $tableName =  $this->GetTableNameFromEntityType($className);
        $fields = $this->dbSchema[$tableName]['fields'];
        $key = $this->dbSchema[$tableName]['key'];
        $keyName = array_keys($key)[0];
        $isAutoIncrement = $key[$keyName];

        $queryFieldBindings = [];
        $queryFields = [];
        foreach(array_keys($fields) as $fieldName)
        {
            if (!($fieldName == $keyName && $isAutoIncrement))
            {
                $queryFieldBindings[] = $fieldName;
                $queryFields[] = ":".$fieldName;
            }
        }

        // construct generic insert query
        $query = "INSERT INTO ".$tableName.
            " (".implode(", ", $queryFieldBindings).
            ") VALUES (".implode(", ", $queryFields).");";

        error_log($query);
        $statement = $this->GetDbHandle()->prepare($query);

        // bind all values to query
        foreach($fields as $fieldName=>$fieldType)
        {
            $statement->bindValue(":".$fieldName, $entity->$fieldName, $this->fieldTypeMap[$fieldType]);
        }

        $statement->execute();

        // return the autoincrement key value
        // possible race condition here
        if ($isAutoIncrement)
        {
            return $this->dbHandle->lastInsertRowID();
        }
        
        return $entity->$keyName;
    }

    // @description
    //  Update an entity in the database
    //
    // @params
    //  entity:         The enttiy with updated fields
    //  updateFields:   An array including the fields which should
    //                  be updated. If no fields are probided or the
    //                  value is null then all entity fields are
    //                  updated.
    public function Update($entity, $updateFields = null)
    {
        $className = get_class($entity);
        $tableName =  $this->GetTableNameFromEntityType($className);
        $keyName = array_keys($this->dbSchema[$tableName]['key'])[0];
        $keyType = $this->dbSchema[$tableName]['fields'][$keyName];
        $updateFields = $updateFields ?? array();

        // If no update fields specified then update ALL table fiedls
        if(count($updateFields) == 0)
        {
            $updateFields = array_keys($this->dbSchema[$tableName]['fields']);
        }

        // Build array of field bindings for query string
        $updateFieldBindings = [];
        foreach($updateFields as $updateField)
        {
            if ($updateField != $keyName)
            {
                $updateFieldBindings[] = $updateField."=:".$updateField;
            }
        }

        // Build query string
        $query = "UPDATE ".$tableName.
            " SET ".implode(", ", $updateFieldBindings).
            " WHERE ".$keyName."=:".$keyName.";";

        error_log($query);
        $statement = $this->GetDbHandle()->prepare($query);

        // bind query statement values
        $statement->bindValue(
            ":".$keyName,
            $entity->$keyName,
            $this->fieldTypeMap[$keyType]);
        
        foreach($updateFields as $updateField)
        {
            if ($updateField != $keyName)
            {
                $updateFieldType = $this->dbSchema[$tableName]['fields'][$updateField];
                $statement->bindValue(":".$updateField, $entity->$updateField, $this->fieldTypeMap[$updateFieldType]);
            }
        }

        $statement->execute();
    }
    
    // Delete an enttiy in the database
    public function Delete($entity)
    {
        $className = get_class($entity);
        $tableName =  $this->GetTableNameFromEntityType($className);
        $fields = array_keys($this->dbSchema[$tableName]['fields']);
        $key = $this->dbSchema[$tableName]['key'];
        $keyName = array_keys($key)[0];
        $keyType = $this->dbSchema[$tableName]['fields'][$keyName];
        $id = $entity->$keyName;

        $query = "DELETE FROM ".$tableName.
            " WHERE ".$keyName."=:".$keyName.";";

        error_log($query);
        $statement = $this->GetDbHandle()->prepare($query);
        $statement->bindValue(
            ":".$keyName,
            $id,
            $this->fieldTypeMap[$keyType]);
        $statement->execute();
    }
    
    public function Read($entity)
    {
        $className = get_class($entity);
        $tableName =  $this->GetTableNameFromEntityType($className);
        $fields = array_keys($this->dbSchema[$tableName]['fields']);
        $key = $this->dbSchema[$tableName]['key'];
        $keyName = array_keys($key)[0];
        $keyType = $this->dbSchema[$tableName]['fields'][$keyName];

        $id = $entity->$keyName;

        $query = "SELECT ".implode(", ", $fields).
            " FROM ".$tableName.
            " WHERE ".$keyName."=:".$keyName.";";

        error_log($query);

        $statement = $this->GetDbHandle()->prepare($query);
        $statement->bindValue(
            ":".$keyName,
            $id,
            $this->fieldTypeMap[$keyType]);
        $result = $statement->execute()->fetchArray();
        
        if($result == null)
        {
            return null;
        }

        foreach($fields as $fieldName)
        {
            $entity->$fieldName = $result[$fieldName];
        }

        return $entity;
    }

    public function ReadAll($entityName)
    {
        $tableName =  $this->GetTableNameFromEntityType($entityName);
        $fields = array_keys($this->dbSchema[$tableName]['fields']);
        $key = $this->dbSchema[$tableName]['key'];
        $keyName = array_keys($key)[0];
        $keyType = $this->dbSchema[$tableName]['fields'][$keyName];
        $isAutoIncrement = $key[$keyName];

        $query = "SELECT ".implode(", ", $fields).
            " FROM ".$tableName.";";
        error_log($query);
        $statement = $this->GetDbHandle()->prepare($query);
        $result = $statement->execute();

        $entityArray = [];
        while ($resultArray = $result->fetchArray())
        {
            $entity = new $entityName();
            foreach($fields as $fieldName)
            {
                $entity->$fieldName = $resultArray[$fieldName];
            }
            $entityArray[] = $entity;
        }

        return $entityArray;
    }
}
?>