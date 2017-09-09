<?php

require_once("DbInitializer.php");
require_once("ICrudRepository.php");

class DbContext implements ICrudRepository
{
    private $dbPath;
    private $dbSchemaPath;
    private $dbHandle;
    private $dbSchema;
    private $fieldTypeMap = [
        'TEXT' => SQLITE3_TEXT,
        'INTEGER' => SQLITE3_TEXT
    ];

    public function __construct(
        $dbPath,
        $dbSchemaPath)
    {
        $this->dbPath = $dbPath;
        $this->dbSchemaPath = $dbSchemaPath;
    }

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
            $init = new DbInitializer($this->dbHandle, $this->GetDbSchema());
            $init->Initialize();
        }

        return $this->dbHandle;
    }

    // Lazy read the schema JSON file on init
    private function GetDbSchema()
    {
        if(!isset($this->dbSchema))
        {
            
            $filedata = file_get_contents($this->dbSchemaPath);
            $this->dbSchema = json_decode($filedata, true);
        }

        return $this->dbSchema;
    }

    // Find the table name related to the entity class name
    private function GetTableNameFromEntityType($entityType)
    {
        $schema = $this->GetDbSchema();

        foreach($schema as $key=>$value)
        {
            if ($value['entityclass'] == $entityType)
            {
                return $key;
            }
        }

        return null;
    }

    // Add new entity to database
    public function Create($entity)
    {
        $className = get_class($entity);
        $tableName =  $this->GetTableNameFromEntityType($className);
        $fields = $this->GetDbSchema()[$tableName]['fields'];
        $key = $this->GetDbSchema()[$tableName]['key'];
        $keyName = array_keys($key)[0];
        $isAutoIncrement = $key[$keyName];

        $queryFieldBindings = array();
        $queryFields = array();
        foreach(array_keys($fields) as $fieldName)
        {
            if (!($fieldName == $keyName && $isAutoIncrement))
            {
                array_push($queryFieldBindings, $fieldName);
                array_push($queryFields, ":".$fieldName);
            }
        }

        $query = "INSERT INTO ".$tableName.
            " (".implode(", ", $queryFieldBindings).
            ") VALUES (".implode(", ", $queryFields).");";

        error_log($query);
        $statement = $this->GetDbHandle()->prepare($query);

        foreach($fields as $fieldName=>$fieldType)
        {
            $statement->bindValue(":".$fieldName, $entity->$fieldName, $this->fieldTypeMap[$fieldType]);
        }

        $statement->execute();
        if ($isAutoIncrement)
        {
            return $this->dbHandle->lastInsertRowID();
        }
        
        return $entity->$keyName;
    }

    public function Update($entity, $updateFields = null)
    {
        $className = get_class($entity);
        $tableName =  $this->GetTableNameFromEntityType($className);
        $keyName = array_keys($this->GetDbSchema()[$tableName]['key'])[0];
        $keyType = $this->GetDbSchema()[$tableName]['fields'][$keyName];
        $updateFields = $updateFields ?? array();

        if(count($updateFields) == 0)
        {
            $updateFields = array_keys($this->GetDbSchema()[$tableName]['fields']);
        }

        $updateFieldBindings = array();
        foreach($updateFields as $updateField)
        {
            if ($updateField != $keyName)
            {
                array_push($updateFieldBindings, $updateField."=:".$updateField);
            }
        }

        $query = "UPDATE ".$tableName.
            " SET ".implode(", ", $updateFieldBindings).
            " WHERE ".$keyName."=:".$keyName.";";

        error_log($query);
        $statement = $this->GetDbHandle()->prepare($query);

        $statement->bindValue(
            ":".$keyName,
            $entity->$keyName,
            $this->fieldTypeMap[$keyType]);
        
        foreach($updateFields as $updateField)
        {
            if ($updateField != $keyName)
            {
                $updateFieldType = $this->GetDbSchema()[$tableName]['fields'][$updateField];
                $statement->bindValue(":".$updateField, $entity->$updateField, $this->fieldTypeMap[$updateFieldType]);
            }
        }

        $statement->execute();
    }
    
    public function Delete($entity)
    {
        $className = get_class($entity);
        $tableName =  $this->GetTableNameFromEntityType($className);
        $fields = array_keys($this->GetDbSchema()[$tableName]['fields']);
        $key = $this->GetDbSchema()[$tableName]['key'];
        $keyName = array_keys($key)[0];
        $keyType = $this->GetDbSchema()[$tableName]['fields'][$keyName];
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
        $fields = array_keys($this->GetDbSchema()[$tableName]['fields']);
        $key = $this->GetDbSchema()[$tableName]['key'];
        $keyName = array_keys($key)[0];
        $keyType = $this->GetDbSchema()[$tableName]['fields'][$keyName];

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
        $fields = array_keys($this->GetDbSchema()[$tableName]['fields']);
        $key = $this->GetDbSchema()[$tableName]['key'];
        $keyName = array_keys($key)[0];
        $keyType = $this->GetDbSchema()[$tableName]['fields'][$keyName];
        $isAutoIncrement = $key[$keyName];

        $query = "SELECT ".implode(", ", $fields).
            " FROM ".$tableName.";";
        error_log($query);
        $statement = $this->GetDbHandle()->prepare($query);
        $result = $statement->execute();

        $entityArray = array();
        while ($resultArray = $result->fetchArray())
        {
            $entity = new $entityName();
            foreach($fields as $fieldName)
            {
                $entity->$fieldName = $resultArray[$fieldName];
            }
            array_push($entityArray, $entity);
        }

        return $entityArray;
    }
}
?>