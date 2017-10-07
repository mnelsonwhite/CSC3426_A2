<h2>Delete Player</h2>
<h3>Are you sure you want to delete?</h3>
<dl>
    <dt>Id</dt>
    <dd><?php echo $model->Id; ?></dd>
    <dt>Team Name</dt>
    <dd><?php echo $model->TeamName; ?></dd>
    <dt>Given Name</dt>
    <dd><?php echo $model->GivenName; ?></dd>
    <dt>Family Name</dt>
    <dd><?php echo $model->FamilyName; ?></dd>
    <dt>Date of Birth</dt>
    <dd><?php echo $model->Dob; ?></dd>
    <dt>Handed</dt>
    <dd><?php echo $model->Handed; ?></dd>
</dl>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $model->Id; ?>" />
    <button type="submit">Confirm</button>
    <a href="<?php echo $this->Url(["view" => "index" ]); ?>">Cancel</a>
</form>
