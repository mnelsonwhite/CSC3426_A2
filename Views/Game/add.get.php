<h1>
    <span><?php print $this->request["Query"]["view"];?></span>
    [<span><?php print $this->request["Method"];?></span>]
</h1>
<form method="POST">
    <div class="form-group">
        <label>Team A Name</label>
        <input type="text" name="TeamAName" placeholder="Team A Name" />
    </div>
    <div class="form-group">
        <label>Team B Name</label>
        <input type="text" name="TeamBName" placeholder="Team B Name" />
    </div>
    <div class="form-group">
        <label>Pool Name</label>
        <input type="text" name="PoolName" placeholder="Pool Name" />
    </div>
    <div class="form-group">
        <label>Score A</label>
        <input type="text" name="ScoreA" placeholder="Score A" />
    </div>
    <div class="form-group">
        <label>Score B</label>
        <input type="text" name="ScoreB" placeholder="Score B" />
    </div>
    <div class="form-group">
        <label>Date</label>
        <input type="text" name="Date" placeholder="Date" />
    </div>
    <button type="submit">Add</button>
</form>