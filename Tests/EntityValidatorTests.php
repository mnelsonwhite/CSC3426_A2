<?php
use PHPUnit\Framework\TestCase;
require_once("Includes/EntityValidator.php");

class TestEntityClass
{
    public $Id;
    public $Name;
    public $ForeignKey;
}

final class EntityValidatorTests extends TestCase
{
    private $validator;

    public function setUp() : void
    {
        $dbSchema = [
            "test" => [
                "fields" => [
                    "Id" => "INTEGER",
                    "Name" => "TEXT",
                    "ForeignKey" => "TEXT"
                ]
            ]
        ];

        $this->validator = new EntityValidator($dbSchema);
    }

    /**
     * @test
     * @dataProvider When_IsFieldDataTypeCorrect_IsCorrect_ShouldBeTrue_Provider 
     * When IsFieldDataTypeCorrect is correct
     * ShouldBe true
     */
    public function When_IsFieldDataTypeCorrect_IsCorrect_ShouldBeTrue(
        $entity,
        $fieldName,
        $dataType
    ) : void
    {
        // Arrange
        // dataProvider

        // Act
        $actual = $this->validator->IsFieldDataTypeCorrect(
            $entity, $fieldName, $dataType);

        // Assert
        $this->assertTrue($actual);
    }

    public function When_IsFieldDataTypeCorrect_IsCorrect_ShouldBeTrue_Provider()
    {
        $entity1 = new TestEntityClass();
        $entity1->Id = "123";

        $entity2 = new TestEntityClass();
        $entity2->Name = "John Doe";

        $entity2 = new TestEntityClass();
        $entity2->ForeignKey = "Key1";

        return [
            [$entity1, "Id", "INTEGER"],
            [$entity2, "Name", "TEXT"],
            [$entity3, "ForeignKey", "TEXT"],
        ];
    }

    /**
     * @test
     * @dataProvider When_IsFieldDataTypeCorrect_IsIncorrect_ShouldBeFalse_Provider 
     * When IsFieldDataTypeCorrect is incorrect
     * ShouldBe false
     */
    public function When_IsFieldDataTypeCorrect_IsIncorrect_ShouldBeFalse(
        $entity,
        $fieldName,
        $dataType
    ) : void
    {
        // Arrange
        // dataProvider

        // Act
        $actual = $this->validator->IsFieldDataTypeCorrect(
            $entity, $fieldName, $dataType);

        // Assert
        $this->assertFalse($actual);
    }

    public function When_IsFieldDataTypeCorrect_IsIncorrect_ShouldBeFalse_Provider()
    {
        $entity1 = new TestEntityClass();
        $entity1->Id = "ABC";

        $entity2 = new TestEntityClass();
        $entity2->Id = "123.123";

        $entity3 = new TestEntityClass();
        $entity3->Id = 123.123;

        $entity4 = new TestEntityClass();
        $entity4->Name = 123;

        return [
            [$entity1, "Id", "INTEGER"],
            [$entity2, "Id", "INTEGER"],
            [$entity3, "Id", "INTEGER"],
            [$entity4, "Name", "TEXT"],
        ];
    }

}

?>