<?php
require_once("Includes/Validation/ValidationViewHelper.php");
$v = new ValidationViewHelper($viewbag["validation"] ?? []);
?>
<h2>Update Game</h2>
<form method="POST">
    <div class="<?php $v->Class("TeamAName"); ?>">
        <input type="hidden" name="Id" value="<?php echo $model->Id;?>" />
        <?php $v->Errors("TeamAName"); ?>
    </div>
    <div class="form-group <?php $v->Class("TeamAName"); ?>">
        <label>Team A Name</label>
        <input type="text" name="TeamAName" placeholder="Team A Name" value="<?php echo $model->TeamAName; ?>" />
        <?php $v->Errors("TeamAName"); ?>
    </div>
    <div class="form-group <?php $v->Class("TeamBName"); ?>">
        <label>Team B Name</label>
        <input type="text" name="TeamBName" placeholder="Team B Name" value="<?php echo $model->TeamBName; ?>" />
        <?php $v->Errors("TeamBName"); ?>
    </div>
    <div class="form-group <?php $v->Class("PoolName"); ?>">
        <label>Pool Name</label>
        <input type="text" name="PoolName" placeholder="Pool Name" value="<?php echo $model->PoolName; ?>" />
        <?php $v->Errors("PoolName"); ?>
    </div>
    <div class="form-group <?php $v->Class("ScoreA"); ?>">
        <label>Score A</label>
        <input type="text" name="ScoreA" placeholder="Score A" value="<?php echo $model->ScoreA; ?>" />
        <?php $v->Errors("ScoreA"); ?>
    </div>
    <div class="form-group <?php $v->Class("ScoreB"); ?>">
        <label>Score B</label>
        <input type="text" name="ScoreB" placeholder="Score B" value="<?php echo $model->ScoreB; ?>" />
        <?php $v->Errors("ScoreB"); ?>
    </div>
    <div class="form-group <?php $v->Class("Date"); ?>">
        <label>Date</label>
        <input type="text" name="Date" placeholder="Date" value="<?php echo $model->Date; ?>" />
        <?php $v->Errors("Date"); ?>
    </div>
    <button type="submit">Update</button>
    <a href="app.php?area=game&view=index">Game Index</a>
</form>