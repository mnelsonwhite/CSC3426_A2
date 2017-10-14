<h2>Team Index</h2>
<a href="<?php echo $this->Url(["view" => "create"]); ?>">Create</a>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Pool Name</th>
        <th>Pool Address</th>
        <th>Pool Length</th>
        <th>Manager</th>
        <th></th>
    </tr>
    </thead>
    <?php foreach($model as $entity): ?>
        <tr>
            <td><?php echo $entity->Name; ?></td>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "area" => "pool", "id" => $entity->PoolName ]); ?>">
                    <?php echo $entity->PoolName; ?>
                </a>
            </td>
            <td>
                <?php echo $viewbag["pools"][$entity->PoolName]->Address ?>
            </td>
            <td>
                <?php echo $viewbag["pools"][$entity->PoolName]->Length ?>
            </td>
            <td><?php echo $entity->Manager; ?></td>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "id" => $entity->Name ]); ?>">detail</a>
                <a href="<?php echo $this->Url(["view" => "update", "id" => $entity->Name ]); ?>">update</a>
                <a href="<?php echo $this->Url(["view" => "delete", "id" => $entity->Name ]); ?>">delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>