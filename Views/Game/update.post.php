<h2>Update Game</h2>
<h3>Updated Game '<span><?php echo $model->Id; ?></span>'</h3>
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
<a href="<?php echo $this->Url(["view" => "index" ]); ?>">Game Index</a>