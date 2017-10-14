<?php
require_once("Includes/Validation/ValidationViewHelper.php");
require_once("Includes/ViewFormHelper.php");

$v = new ValidationViewHelper($viewbag["validation"] ?? []);
$f = new ViewFormHelper($v, $model);
?>
<h2>Update Team</h2>
<form method="POST">
    <div class="form-group <?php echo $v->Class("Name"); ?>">
        <label>Name</label>
        <input type="hidden" name="Name" value="<?php echo $model->Name;?>" />
        <input type="text" value="<?php echo $model->Name;?>" disabled />
        <?php echo $v->Errors("Name"); ?>
    </div>
    <?php echo $f->SelectInput("PoolName", $viewbag["Pools"], "Pool Name"); ?>
    <?php echo $f->TextInput("Manager"); ?>
    <button type="submit">Update</button>
    <a href="<?php echo $this->Url(["view" => "index"]); ?>">Team Index</a>
</form>