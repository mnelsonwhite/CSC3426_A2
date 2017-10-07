<h2>Pool Index</h2>
<a href="<?php echo $this->Url(["view" => "add"]); ?>">Add</a>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Length</th>
        <th>Address</th>
        <th></th>
    </tr>
    </thead>
    <?php foreach($model as $entity): ?>
        <tr>
            <td>
            <?php echo $entity->Name; ?>
            </td>
            <td><?php echo $entity->Length; ?></td>
            <td><?php echo $entity->Address; ?></td>
            <td>
                <a href="<?php echo $this->Url(["view" => "update", "id" => $entity->Name ]); ?>">update</a>
                <a href="<?php echo $this->Url(["view" => "delete", "id" => $entity->Name ]); ?>">delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>