<?php

class ValidationViewHelper
{
    private $validationResult;

    public function __construct(array $validationResult)
    {
        $this->validationResult = $validationResult;
    }

    public function Class(string $name)
    {
        echo isset($this->validationResult)
            && array_key_exists($name, $this->validationResult)
            ? "validation-errors" : null;
    }

    public function Errors(string $name)
    {
        if(isset($this->validationResult)
        && array_key_exists($name, $this->validationResult))
        {
            echo "<ul>";
            foreach($this->validationResult[$name] as $error)
            {
                echo "<li>".$error."</li>";
            }
            echo "</ul>";
        }
    }
}

?>