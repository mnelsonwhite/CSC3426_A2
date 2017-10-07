<h2>Add Team</h2>
<h3>Added new team</h3>
<dl>
    <dt>Name</dt>
    <dd><?php echo $model->Name; ?></dd>
    <dt>Pool Name</dt>
    <dd><?php echo $model->PoolName; ?></dd>
    <dt>Manager</dt>
    <dd><?php echo $model->Manager; ?></dd>
</dl>
<a href="<?php echo $this->Url(["view" => "index" ]); ?>">Team Index</a>