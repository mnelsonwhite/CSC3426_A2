<h1>Team Index</h1>
<a href="<?php echo $this->Url(["view" => "create"]); ?>" class="btn" title="Create Team">Create Team</a>
<table class="data-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Manager</th>
        <th>Pool Name</th>
        <th>Pool Address</th>
        <th>Pool Length</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($model as $entity): ?>
    <tr onclick="document.location = '<?php echo $this->Url(["view" => "detail", "id" => $entity->Name]); ?>';" title="Update">
            <td><?php echo $entity->Name; ?></td>
            <td><?php echo $entity->Manager; ?></td>
            <td><?php echo $entity->PoolName; ?></td>
            <td><?php echo $viewbag["pools"][$entity->PoolName]->Address ?></td>
            <td><?php echo $viewbag["pools"][$entity->PoolName]->Length ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>