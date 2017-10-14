<?php
require_once("Includes/Validation/ValidationViewHelper.php");
require_once("Includes/ViewFormHelper.php");

$v = new ValidationViewHelper($viewbag["validation"] ?? []);
$f = new ViewFormHelper($v, $model);
?>
<h2>Create Team</h2>
<form method="POST">
    <?php echo $f->TextInput("Name"); ?>
    <?php echo $f->SelectInput("PoolName", $viewbag["Pools"], "Pool Name"); ?>
    <?php echo $f->TextInput("Manager"); ?>
    <button type="submit">Create</button>
    <a href="<?php echo $this->Url(["view" => "index" ]); ?>">Team Index</a>
</form>