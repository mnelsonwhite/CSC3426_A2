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

    public function Like($field, string $value) : QueryFilter
    {
        $this->Op($field, $value, "LIKE");
        return $this;
    }


    public function Eq($field, $value) : QueryFilter
    {
        $this->Op($field, $value, "=");
        return $this;
    }

    public function Ne($field, $value) : QueryFilter
    {
        $this->Op($field, $value, "!=");
        return $this;
    }

    public function Gt($field, $value) : QueryFilter
    {
        $this->Op($field, $value, ">");
        return $this;
    }

    public function Lt($field) : QueryFilter
    {
        $this->Op($field, $value, "<");
        return $this;
    }

    public function And() : QueryFilter
    {
        $this->filter .= " AND ";
        return $this;
    }

    public function Or() : QueryFilter
    {
        $this->filter .= " OR ";
        return $this;
    }

    public function __toString()
    {
        return count($this->fields) > 0
            ? $this->filter
            : "";
    }

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

    private function Op($field, $value, $operator)
    {
        $this->filter .= "$field $operator :$field";
        $this->fields["$field"] = $value;
    }

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