<h1>Delete Pool</h1>
<h3>Are you sure you want to delete?</h3>
<dl>
    <dt>Name</dt>
    <dd><?php echo $model->Name; ?></dd>
    <dt>Length</dt>
    <dd><?php echo $model->Length; ?></dd>
    <dt>Address</dt>
    <dd><?php echo $model->Address; ?></dd>
</dl>
<form method="POST">
    <input type="hidden" name="Name" value="<?php echo $model->Name; ?>" />
    <button type="submit">Confirm</button>
    <a href="<?php echo $this->Url(["view" => "index" ]); ?>">Cancel</a>
</form>
