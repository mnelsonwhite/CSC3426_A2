<?php
require_once("Includes/Validation/ValidationViewHelper.php");
require_once("Includes/ViewFormHelper.php");

$v = new ValidationViewHelper($viewbag["validation"] ?? []);
$f = new ViewFormHelper($v, $model);
?>
<h2>Create Pool</h2>
<form method="POST">
    <?php echo $f->TextInput("Name"); ?>
    <?php echo $f->TextInput("Length"); ?>
    <?php echo $f->TextInput("Address"); ?>
    <button type="submit">Create</button>
    <a href="<?php echo $this->Url(["view" => "index" ]); ?>">Pool Index</a>
</form>