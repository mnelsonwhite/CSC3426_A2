<?php
// Interface for CRUD Repository
interface ICrudRepository
{
    public function Create($entity);
    public function Read($id);
    public function Update($entity);
    public function Delete($id);
}
?>
