<h2>Team Detail</h2>
<dl>
    <dt>Name</dt>
    <dd><?php echo $model->Name; ?></dd>
    <dt>Pool Name</dt>
    <dd><?php echo $model->PoolName; ?></dd>
    <dt>Address</dt>
    <dd><?php echo $model->Manager; ?></dd>
</dl>
<a href="<?php echo $this->Url(["view" => "index"]); ?>">Team Index</a>