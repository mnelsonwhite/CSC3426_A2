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
    </tr>
    </thead>
    <?php foreach($model as $entity): ?>
    <tr onclick="document.location = '<?php echo $this->Url(["view" => "detail", "id" => $entity->Name]); ?>';">
            <td><?php echo $entity->Name; ?></td>
            <td><?php echo $entity->PoolName; ?></td>
            <td><?php echo $viewbag["pools"][$entity->PoolName]->Address ?></td>
            <td><?php echo $viewbag["pools"][$entity->PoolName]->Length ?></td>
            <td><?php echo $entity->Manager; ?></td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>