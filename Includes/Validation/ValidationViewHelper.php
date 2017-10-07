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
        return isset($this->validationResult)
            && array_key_exists($name, $this->validationResult)
            ? "validation-errors" : "";
    }

    public function Errors(string $name)
    {
        if(isset($this->validationResult)
        && array_key_exists($name, $this->validationResult))
        {
            $ul = "<ul>";
            foreach($this->validationResult[$name] as $error)
            {
                $ul = $ul."<li>".$error."</li>";
            }
            return $ul."</ul>";
        }
    }
}

?>