<h1>
    <span><?php print $this->request["Query"]["view"];?></span>
    [<span><?php print $this->request["Method"];?></span>]
</h1>
<form method="POST">
    <input type="hidden" name="Id" value="<?php echo $model->Id;?>" />
    <div class="form-group">
        <label>Team A Name</label>
        <input type="text" name="TeamAName" placeholder="Team A Name" value="<?php echo $model->TeamAName; ?>" />
    </div>
    <div class="form-group">
        <label>Team B Name</label>
        <input type="text" name="TeamBName" placeholder="Team B Name" value="<?php echo $model->TeamBName; ?>" />
    </div>
    <div class="form-group">
        <label>Pool Name</label>
        <input type="text" name="PoolName" placeholder="Pool Name" value="<?php echo $model->PoolName; ?>" />
    </div>
    <div class="form-group">
        <label>Score A</label>
        <input type="text" name="ScoreA" placeholder="Score A" value="<?php echo $model->ScoreA; ?>" />
    </div>
    <div class="form-group">
        <label>Score B</label>
        <input type="text" name="ScoreB" placeholder="Score B" value="<?php echo $model->ScoreB; ?>"/>
    </div>
    <div class="form-group">
        <label>Date</label>
        <input type="text" name="Date" placeholder="Date" value="<?php echo $model->Date; ?>"/>
    </div>
    <button type="submit">Edit</button>
    <a href="app.php?area=game&view=index">Game Index</a>
</form>