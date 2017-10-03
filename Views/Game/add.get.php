<?php

class ValidationHelper
{
    private $validationResult;

    public function __construct(array $validationResult)
    {
        $this->validationResult = $validationResult;
    }

    public function Class(string $name)
    {
        echo isset($this->validationResult)
            && array_key_exists($name, $this->validationResult)
            ? "validation-errors" : null;
    }

    public function Errors(string $name)
    {
        if(isset($this->validationResult)
        && array_key_exists($name, $this->validationResult))
        {
            echo "<ul>";
            foreach($this->validationResult[$name] as $error)
            {
                echo "<li>".$error."</li>";
            }
            echo "</ul>";
        }
    }
}

$v = new ValidationHelper($viewbag["validation"]);
?>
<style>
    input {
        border: 1px solid #ccc;
    }
    .validation-errors input{
        border-color: red;
    }

    .validation-errors li, .validation-errors label {
        color: red;
    }
</style>
<h1>
    <span><?php print $this->request["Query"]["view"];?></span>
    [<span><?php print $this->request["Method"];?></span>]
</h1>
<form method="POST">
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
    <button type="submit">Add</button>
</form>