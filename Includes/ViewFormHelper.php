<?php

class ViewFormHelper
{
    private $validationHelper;
    private $model;
    public function __construct($validationHelper, $model)
    {
        $this->validationHelper = $validationHelper;
        $this->model = $model;
    }

    public function TextInput($field, $display = null)
    {
        return $this->Input($field, $display, "text");
    }

    public function Input($field, $display = null, $type)
    {
        $display = $display ?? $field;

        $form = "<div class=\"form-group ".$this->validationHelper->Class($field)."\">";
        $form .= "<label>$display</label>";
        $form .= "<input type=\"$type\" name=\"$field\" placeholder=\"$display\" value=\"".$this->model->$field."\" />";
        $form .= $this->validationHelper->Errors($field);
        $form .= "</div>";
        return $form;
    }

    public function SelectInput($field, $options, $display = null)
    {
        $display = $display ?? $field;
        $selectedValue = $this->model->$field ?? null;

        $form = "<div class=\"form-group ".$this->validationHelper->Class($field)."\">";
        $form .= "<label>$display</label>";
        $form .= "<select name=\"$field\" >";
        
        $selected = $selectedValue == null ? "selected" : "";
        $form .= "<option $selected>Select one...</option>";

        foreach($options as $value=>$text)
        {
            $selected = $value == $selectedValue ? "selected" : "";
            $form .= "<option $selected value=\"$value\">$text</option>";
        }

        $form .= "</select>";

        $form .= $this->validationHelper->Errors($field);
        $form .= "</div>";
        return $form;
    }
}

?>