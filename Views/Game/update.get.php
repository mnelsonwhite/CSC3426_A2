<?php
require_once("Includes/Validation/ValidationViewHelper.php");
require_once("Includes/ViewFormHelper.php");

$v = new ValidationViewHelper($viewbag["validation"] ?? []);
$f = new ViewFormHelper($v, $model);
?>
<h1>Update Game</h1>
<form method="POST">
    <div class="<?php echo $v->Class("Id"); ?>">
        <input type="hidden" name="Id" value="<?php echo $model->Id;?>" />
        <?php echo $v->Errors("Id"); ?>
    </div>
    <?php echo $f->SelectInput("TeamAName", $viewbag["Teams"], "Team A Name"); ?>
    <?php echo $f->SelectInput("TeamBName", $viewbag["Teams"], "Team B Name"); ?>
    <?php echo $f->SelectInput("PoolName", $viewbag["Pools"], "Pool Name"); ?>
    <?php echo $f->TextInput("ScoreA", "Score A"); ?>
    <?php echo $f->TextInput("ScoreB", "Score B"); ?>
    <?php echo $f->Input("Date", "Date", "date"); ?>
    <button type="submit" class="btn">Update</button>
</form>