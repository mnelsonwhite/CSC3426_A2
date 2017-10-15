<h1>Delete Game</h1>
<h3>Are you sure you want to delete?</h3>
<dl>
    <dt>Id</dt>
    <dd><?php echo $model->Id; ?></dd>
    <dt>Team A Name</dt>
    <dd><?php echo $model->TeamAName; ?></dd>
    <dt>Team B Name</dt>
    <dd><?php echo $model->TeamBName; ?></dd>
    <dt>Pool Name</dt>
    <dd><?php echo $model->PoolName; ?></dd>
    <dt>Score A</dt>
    <dd><?php echo $model->ScoreA; ?></dd>
    <dt>Score B</dt>
    <dd><?php echo $model->ScoreB; ?></dd>
    <dt>Date</dt>
    <dd><?php echo $model->Date; ?></dd>
</dl>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $model->Id; ?>" />
    <button type="submit">Confirm</button>
    <a href="<?php echo $this->Url(["view" => "index"]); ?>">Cancel</a>
</form>
