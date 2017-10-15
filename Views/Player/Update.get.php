<?php
require_once("Includes/Validation/ValidationViewHelper.php");
require_once("Includes/ViewFormHelper.php");

$v = new ValidationViewHelper($viewbag["validation"] ?? []);
$f = new ViewFormHelper($v, $model);
?>
<h1>Update Player</h1>
<form method="POST">
    <div class="<?php echo $v->Class("Id"); ?>">
        <input type="hidden" name="Id" value="<?php echo $model->Id;?>" />
        <?php echo $v->Errors("Id"); ?>
    </div>
    <?php echo $f->SelectInput("TeamName", $viewbag["Teams"], "Team Name"); ?>
    <?php echo $f->TextInput("GivenName", "Given Name"); ?>
    <?php echo $f->TextInput("FamilyName", "Family Name"); ?>
    <?php echo $f->TextInput("Dob", "Date of Birth", "date"); ?>
    <?php echo $f->SelectInput("Handed", ["Left" => "Left", "Right" => "Right"]); ?>
    <button type="submit" class="btn">Update</button>
</form>