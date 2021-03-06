<?php
require_once("Includes/Validation/ValidationViewHelper.php");
require_once("Includes/ViewFormHelper.php");

$v = new ValidationViewHelper($viewbag["validation"] ?? []);
$f = new ViewFormHelper($v, $model);

?>
<h1>Create Game</h1>
<form method="POST">
    <?php echo $f->SelectInput("TeamAName", $viewbag["Teams"], "Team A Name"); ?>
    <?php echo $f->SelectInput("TeamBName", $viewbag["Teams"], "Team B Name"); ?>
    <?php echo $f->SelectInput("PoolName", $viewbag["Pools"], "Pool Name"); ?>
    <?php echo $f->TextInput("ScoreA", "Score A"); ?>
    <?php echo $f->TextInput("ScoreB", "Score B"); ?>
    <?php echo $f->Input("Date", "Date", "date"); ?>
    <button type="submit" class="btn">Create</button>
</form>