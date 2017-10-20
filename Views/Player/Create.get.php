<?php
require_once("Includes/Validation/ValidationViewHelper.php");
require_once("Includes/ViewFormHelper.php");

$v = new ValidationViewHelper($viewbag["validation"] ?? []);
$f = new ViewFormHelper($v, $model);

?>
<h1>Create Player</h1>
<form method="POST">
    <?php echo $f->SelectInput("TeamName", $viewbag["Teams"], "Team Name"); ?>
    <?php echo $f->TextInput("GivenName", "Given Name"); ?>
    <?php echo $f->TextInput("FamilyName", "Family Name"); ?>
    <?php echo $f->Input("Dob", "Date of Birth", "date"); ?>
    <?php echo $f->SelectInput("Handed", ["Left" => "Left", "Right" => "Right"]); ?>
    <button type="submit" class="btn">Create</button>
</form>