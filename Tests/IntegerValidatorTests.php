<?php

require_once("Includes/Validation/IntegerValidator.php");

use PHPUnit\Framework\TestCase;

final class IntegerValidatorTests extends TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new IntegerValidator();
    }

    /**
     * @test
     * @dataProvider ValidIntegers 
     */
    public function WhenValidInteger_ShouldBeBool($value)
    {
        // Arrange

        // Act
        $actual = $this->validator->ValidateField($value);

        // Assert
        $this->assertTrue(is_bool($actual));
    }

    /**
     * @test
     * @dataProvider ValidIntegers 
     */
    public function WhenValidInteger_ShouldBeTrue($value)
    {
        // Arrange
 
        // Act
        $actual = $this->validator->ValidateField($value);
 
        // Assert
        $this->assertTrue($actual);
    }

    /**
     * @test
     * @dataProvider InvalidIntegers 
     */
    public function WhenInvalidInteger_ShouldBeString($value)
    {
        // Arrange
  
        // Act
        $actual = $this->validator->ValidateField($value);
  
        // Assert
        $this->assertTrue(is_string($actual));
    }

    /**
     * @test
     */
    public function WhenInvalidInteger_ShouldBeDefaultMessage()
    {
        // Arrange
        $value = "not an integer";
        $expected = "Value must be an integer";
        
        // Act
        $actual = $this->validator->ValidateField($value);

        // Assert
        $this->assertEquals($expected, $actual);
    }

    public function ValidIntegers()
    {
        return [
            [1],
            ["1"],
            [1234567],
            [-1],
            ["-1"]
        ];
    }

    public function InValidIntegers()
    {
        return [
            [-1.121212],
            [1.1],
            ["1A"],
            ["1 A"],
            ["A1"],
            [date()]
        ];
    }
}

?>