<?php

require_once("Includes/Validation/DateValidator.php");

use PHPUnit\Framework\TestCase;

final class DateValidatorTests extends TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new DateValidator();
    }

    /**
     * @test
     * @dataProvider ValidValues 
     */
    public function WhenValid_ShouldBeBool($value)
    {
        // Arrange

        // Act
        $actual = $this->validator->ValidateField($value);

        // Assert
        $this->assertTrue(is_bool($actual));
    }

    /**
     * @test
     * @dataProvider ValidValues 
     */
    public function WhenValid_ShouldBeTrue($value)
    {
        // Arrange
 
        // Act
        $actual = $this->validator->ValidateField($value);
 
        // Assert
        $this->assertTrue($actual);
    }

    /**
     * @test
     * @dataProvider InvalidValues 
     */
    public function WhenInvalid_ShouldBeString($value)
    {
        // Arrange
  
        // Act
        $actual = $this->validator->ValidateField($value);
  
        // Assert
        $this->assertTrue(is_string($actual));
    }

    /**
     * @test
     * @dataProvider ValidFormattedValues
     */
    public function WhenValidAndFormatted_ShouldBeTrue($value, $format)
    {
        // Arrange
        $args = [
            "format" => $format
        ];

        // Act
        $actual = $this->validator->ValidateField($value, $args);
        
        // Assert
        $this->assertTrue($actual);
    }

    /**
     * @test
     * @dataProvider InvalidFormattedValues
     */
    public function WhenInvalidAndFormatted_ShouldBeString($value, $format)
    {
        // Arrange
        $args = [
            "format" => $format
        ];

        // Act
        $actual = $this->validator->ValidateField($value, $args);
        
        // Assert
        $this->assertTrue(is_string($actual));
    }

    public function ValidValues()
    {
        return [
            ["2001-01-1"],
            ["2001-2-28"],
            ["1-1-1"],
        ];
    }

    public function ValidFormattedValues()
    {
        return [
            ["20010101", "Ymd"],
            ["20010228", "Ymd"],
            ["20201231", "Ymd"],
        ];
    }

    public function InvalidFormattedValues()
    {
        return [
            ["2001-01-01", "Ymd"],
            ["2001/02/28", "Ymd"],
            ["20010229", "Ymd"],
        ];
    }

    public function InvalidValues()
    {
        return [
            [-1.121212],
            [1.1],
            ["1A"],
            ["1 A"],
            ["A1"],
            ["2001-2-29"],
            ["2001-13-29"],
        ];
    }
}

?>