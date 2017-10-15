<h1><?php echo $model->Name; ?> Team Detail</h1>
<a class="btn" href="<?php echo $this->Url(["view" => "update", "id" => $model->Name ]); ?>">Update</a>
<a class="btn" href="<?php echo $this->Url(["view" => "delete", "id" => $model->Name ]); ?>">Delete</a>
<dl>
    <dt>Manager</dt>
    <dd><?php echo $model->Manager; ?></dd>
</dl>

<h2>Pool</h2>
<a class="btn" href="<?php echo $this->Url(["view" => "updatepool", "id" => $model->Pool->Name ]); ?>">Update Team Pool</a>
<dl>
    <dt>Pool Name</dt>
    <dd><?php echo $model->Pool->Name; ?></dd>
    <dt>Pool Address</dt>
    <dd><?php echo $model->Pool->Address; ?></dd>
    <dt>Pool Length</dt>
    <dd><?php echo $model->Pool->Length; ?></dd>
</dl>

<h2>Players</h2>
<a class="btn" href="<?php echo $this->Url(["view" => "createplayer", "id" => $model->Name ]); ?>">Create Team Player</a>
<table class="data-table">
    <thead>
    <tr>
        <th>Given Name</th>
        <th>Family Name</th>
        <th>Date of Birth</th>
        <th>Handed</th>
    </tr>
    </thead>
    <?php foreach($model->Players as $entity): ?>
    <tr onclick="document.location = '<?php echo $this->Url(["area" => "player", "view" => "update", "id" => $entity->Id]); ?>';" title="Edit">
            <td><?php echo $entity->GivenName; ?></td>
            <td><?php echo $entity->FamilyName; ?></td>
            <td><?php echo $entity->Dob; ?></td>
            <td><?php echo $entity->Handed; ?></td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>

<h2>Games</h2>
<a class="btn" href="<?php echo $this->Url(["view" => "creategame", "id" => $model->Name ]); ?>">Create Team Game</a>
<table class="data-table">
    <thead>
    <tr>
        <th>Team A Name</th>
        <th>Team B Name</th>
        <th>Pool Name</th>
        <th>Score A</th>
        <th>Score B</th>
        <th>Date</th>
    </tr>
    </thead>
    <?php foreach($model->Games as $entity): ?>
        <tr onclick="document.location = '<?php echo $this->Url(["area" => "game", "view" => "update", "id" => $entity->Id]); ?>';" title="Edit">
            <td><?php echo $entity->TeamAName; ?></td>
            <td><?php echo $entity->TeamBName; ?></td>
            <td><?php echo $entity->PoolName; ?></td>
            <td><?php echo $entity->ScoreA; ?></td>
            <td><?php echo $entity->ScoreB; ?></td>
            <td><?php echo $entity->Date; ?></td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>