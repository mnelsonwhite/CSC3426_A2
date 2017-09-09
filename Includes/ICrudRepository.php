<?php
// Interface for CRUD Repository
interface ICrudRepository
{
    public function Create($entity);
    public function Read($entity);
    public function ReadAll($entityName);
    public function Update($entity, $updateFields);
    public function Delete($entity);
}
?>
