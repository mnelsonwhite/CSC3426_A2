<h2>Add Pool</h2>
<h3>Added new pool</h3>
<dl>
    <dt>Name</dt>
    <dd><?php echo $model->Name; ?></dd>
    <dt>Length</dt>
    <dd><?php echo $model->Length; ?></dd>
    <dt>Address</dt>
    <dd><?php echo $model->Address; ?></dd>
</dl>
<a href="<?php echo $this->Url(["view" => "index" ]); ?>">Pool Index</a>