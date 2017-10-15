<?php
require_once("Includes/Validation/ValidationViewHelper.php");
require_once("Includes/ViewFormHelper.php");

$v = new ValidationViewHelper($viewbag["validation"] ?? []);
$f = new ViewFormHelper($v, $model);
?>
<h1>Create Team</h1>
<form method="POST">
    <?php echo $f->TextInput("Name"); ?>
    <?php echo $f->SelectInput("PoolName", $viewbag["Pools"], "Pool Name"); ?>
    <?php echo $f->TextInput("Manager"); ?>
    <button type="submit" class="btn">Create</button>
</form>