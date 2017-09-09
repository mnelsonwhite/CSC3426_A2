<?php

require_once("DependencyGraphResolver.php");

class DbInitializer
{
    private $dbHandle;
    private $dbSchema;

    public function __construct($dbHandle, $dbSchema)
    {
        $this->dbHandle = $dbHandle;
        $this->dbSchema = $dbSchema;
    }

    // Initialize table
    private function InitTable($tableName)
    {
        $fields = $this->dbSchema[$tableName]['fields'];
        $key = $this->dbSchema[$tableName]['key'];

        $fieldDeclr = array();
        foreach($fields as $fieldName=>$fieldType)
        {
            array_push(
                $fieldDeclr,
                $this->FieldDeclaration(
                    $fieldName,
                    $fieldType,
                    $key,
                    $tableName));
        }

        $fKeys = $this->dbSchema[$tableName]['fkey'];

        if ($fKeys != null)
        {
            foreach($fKeys as $fKeyField=>$fKeyTable)
            {
                array_push(
                    $fieldDeclr,
                    $this->ForeignKeyDeclaration($fKeyField, $fKeyTable)
                );
            }
        }
        
        $query = "CREATE TABLE IF NOT EXISTS ".$tableName.
            " (".implode(", ", $fieldDeclr).");";

        try
        {
            $statement = $this->dbHandle->prepare($query);
            $statement->execute();
        }
        catch(Exception $exception)
        {
            error_log($exception);
        }
        
    }

    // return string for foreign key constraint
    private function ForeignKeyDeclaration($fieldName, $tableName)
    {
        $key = array_keys($this->dbSchema[$tableName]['key'])[0];
        
        return "FOREIGN KEY (".$fieldName.
        ") REFERENCES ".$tableName.
        "(".$key.")";
    }

    // return table field declaration
    public function FieldDeclaration($fieldName, $fieldType, $tableKey, $tableName)
    {
        $keyName = array_keys($tableKey)[0];
        $isAutoIncrement = $tableKey[$keyName];
        $declr = $fieldName. " ".$fieldType;
        
        // declare key
        if($keyName == $fieldName)
        {
            $declr = $declr. " PRIMARY KEY";

            if ($isAutoIncrement)
            {
                $declr = $declr . " AUTOINCREMENT";
            }
        }

        return $declr;
    }

    public function Initialize()
    {
        // Resolve foreign key dependency graph for
        // valid constraints
        $resolver = new DependencyGraphResolver();
        $dependencies = $resolver->GetDependencyOrder($this->dbSchema);
        
        foreach($dependencies as $table)
        {
            $this->InitTable($table);
        }
    }
}

?>