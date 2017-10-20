<?php
/*
* A generic filter builder with fluent API.
* Uses PDO binding for safe queries.
* Automatic binding for integer and text.
*/
class QueryFilter
{
    private $filter;
    private $fields;

    public function __construct()
    {
        $this->filter = "WHERE ";
        $this->fields = [];
    }

    // Field is LIKE string value. Use wildcards % in string
    // for partial matches
    public function Like($field, string $value) : QueryFilter
    {
        $this->Op($field, $value, "LIKE");
        return $this;
    }

    // Field is equal to value
    public function Eq($field, $value) : QueryFilter
    {
        $this->Op($field, $value, "=");
        return $this;
    }

    // Field is not equal to value
    public function Ne($field, $value) : QueryFilter
    {
        $this->Op($field, $value, "!=");
        return $this;
    }

    // Field is greater than value
    public function Gt($field, $value) : QueryFilter
    {
        $this->Op($field, $value, ">");
        return $this;
    }

    // Field is less than value
    public function Lt($field) : QueryFilter
    {
        $this->Op($field, $value, "<");
        return $this;
    }

    // Logical AND to join conditions
    public function And() : QueryFilter
    {
        $this->filter .= " AND ";
        return $this;
    }

    // Logical OR to join conditions
    public function Or() : QueryFilter
    {
        $this->filter .= " OR ";
        return $this;
    }

    // if no fields then no filter
    public function __toString()
    {
        return count($this->fields) > 0
            ? $this->filter
            : "";
    }

    // Bind fields to provided statement
    public function Bind(SQLite3Stmt $statement)
    {
        foreach($this->fields as $fieldName=>$value)
        {
            $statement->bindValue(
                ":$fieldName",
                $value,
                $this->GetDbType($value));
        }
    }

    // Allow multiple conditions on a single field
    private function Op($field, $value, $operator)
    {
        $count = count($this->fields);
        $this->filter .= "$field $operator :$count";
        $this->fields[$count] = $value;
    }

    // Find supported db data type for binding
    private function GetDbType($value) : int
    {
        if (filter_var($value, FILTER_VALIDATE_INT))
        {
            return SQLITE3_INTEGER;
        }
        else if (is_string($value))
        {
            return SQLITE3_TEXT;
        }

        throw new Exception("unsupported type");
    }
}

?>