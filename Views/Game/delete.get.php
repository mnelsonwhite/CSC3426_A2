<h1>
    <span><?php print $this->request["Query"]["view"];?></span>
    [<span><?php print $this->request["Method"];?></span>]
</h1>
<h2>Are you sure you want to delete?</h2>
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
    <a href="app.php?area=game&view=index">Cancel</a>
</form>