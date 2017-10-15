<h1>Player Detail</h1>
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
<a href="<?php echo $this->Url(["view" => "index" ]); ?>">Player Index</a>