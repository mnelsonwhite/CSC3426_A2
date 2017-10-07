<h2>Delete Team</h2>
<h3>Are you sure you want to delete?</h3>
<dl>
    <dt>Name</dt>
    <dd><?php echo $model->Name; ?></dd>
    <dt>Pool Name</dt>
    <dd><?php echo $model->PoolName; ?></dd>
    <dt>Manager</dt>
    <dd><?php echo $model->Manager; ?></dd>
</dl>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $model->Id; ?>" />
    <button type="submit">Confirm</button>
    <a href="<?php echo $this->Url(["view" => "index" ]); ?>">Cancel</a>
</form>
