<?php

require_once("Includes/Validation/RequiredValidator.php");

use PHPUnit\Framework\TestCase;

final class RequiredValidatorTests extends TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new RequiredValidator();
    }

    /**
     * @test
     * @dataProvider ValidValues
     */
    public function WhenSet_ShouldBeBool($value)
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
    public function WhenSet_ShouldBeTrue($value)
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
    public function WhenNotSet_ShouldBeString()
    {
        // Arrange
        $value = null;
  
        // Act
        $actual = $this->validator->ValidateField($value);
  
        // Assert
        $this->assertTrue(is_string($actual));
    }

    public function ValidValues()
    {
        return [
            [1],
            [1.1],
            [new DateTime()],
            ["something"],
            [true],
            [false],
            ["true"],
            ["false"]
        ];
    }

    public function InvalidValues()
    {
        return [
            [null],
            [],
            [""],
            [[]],
            ["0"]
        ];
    }
}

?>