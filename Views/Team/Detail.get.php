<h2>Team Detail</h2>
<dl>
    <dt>Name</dt>
    <dd><?php echo $model->Name; ?></dd>
    <dt>Pool Name</dt>
    <dd><?php echo $model->PoolName; ?></dd>
    <dt>Pool Address</dt>
    <dd><?php echo $model->Pool->Address; ?></dd>
    <dt>Pool Length</dt>
    <dd><?php echo $model->Pool->Length; ?></dd>
    <dt>Manager</dt>
    <dd><?php echo $model->Manager; ?></dd>
</dl>
<a href="<?php echo $this->Url(["view" => "index"]); ?>">Index</a>
<a href="<?php echo $this->Url(["view" => "update", "id" => $model->Name ]); ?>">Update</a>
<hr />
<h2>Players</h2>
<table>
    <thead>
    <tr>
        <th>Given Name</th>
        <th>Family Name</th>
        <th>Date of Birth</th>
        <th>Handed</th>
        <th></th>
    </tr>
    </thead>
    <?php foreach($model->Players as $entity): ?>
        <tr>
            <td><?php echo $entity->GivenName; ?></td>
            <td><?php echo $entity->FamilyName; ?></td>
            <td><?php echo $entity->Dob; ?></td>
            <td><?php echo $entity->Handed; ?></td>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "area" => "player", "id" => $entity->Id ]); ?>">detail</a>
                <a href="<?php echo $this->Url(["view" => "update", "area" => "player", "id" => $entity->Id ]); ?>">update</a>
                <a href="<?php echo $this->Url(["view" => "delete", "area" => "player", "id" => $entity->Id ]); ?>">delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>
<hr />
<h2>Games</h2>
<table>
    <thead>
    <tr>
        <th>Team A Name</th>
        <th>Team B Name</th>
        <th>Pool Name</th>
        <th>Score A</th>
        <th>Score B</th>
        <th>Date</th>
        <th></th>
    </tr>
    </thead>
    <?php foreach($model->Games as $entity): ?>
        <tr>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "area" => "team", "id" => $entity->TeamAName ]); ?>">
                    <?php echo $entity->TeamAName; ?>
                </a>
            </td>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "area" => "team", "id" => $entity->TeamBName ]); ?>">
                    <?php echo $entity->TeamBName; ?>
                </a>
            </td>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "area" => "pool", "id" => $entity->PoolName ]); ?>">
                    <?php echo $entity->PoolName; ?>
                </a>
            </td>
            <td><?php echo $entity->ScoreA; ?></td>
            <td><?php echo $entity->ScoreB; ?></td>
            <td><?php echo $entity->Date; ?></td>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "area" => "game", "id" => $entity->Id ]); ?>">detail</a>
                <a href="<?php echo $this->Url(["view" => "update", "area" => "game", "id" => $entity->Id ]); ?>">update</a>
                <a href="<?php echo $this->Url(["view" => "delete", "area" => "game", "id" => $entity->Id ]); ?>">delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>