<h2>Team Index</h2>
<a href="<?php echo $this->Url(["view" => "add"]); ?>">Add</a>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Pool Name</th>
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
            <td><?php echo $entity->Manager; ?></td>
            <td>
                <a href="<?php echo $this->Url(["view" => "update", "id" => $entity->Name ]); ?>">update</a>
                <a href="<?php echo $this->Url(["view" => "delete", "id" => $entity->Name ]); ?>">delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>