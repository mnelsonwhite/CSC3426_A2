<?php
require_once("Includes/Validation/ValidationViewHelper.php");
require_once("Includes/ViewFormHelper.php");

$v = new ValidationViewHelper($viewbag["validation"] ?? []);
$f = new ViewFormHelper($v, $model);
?>
<h2>Create Player</h2>
<form method="POST">
    <?php echo $f->SelectInput("TeamName", $viewbag["Teams"], "Team Name"); ?>
    <?php echo $f->TextInput("GivenName", "Given Name"); ?>
    <?php echo $f->TextInput("FamilyName", "Family Name"); ?>
    <?php echo $f->Input("Dob", "Date of Birth", "date"); ?>
    <?php echo $f->SelectInput("Handed", ["Left", "Right"]); ?>
    <button type="submit">Create</button>
    <a href="<?php echo $this->Url(["view" => "index" ]); ?>">Player Index</a>
</form>