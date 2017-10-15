<h1>Pool Index</h1>
<a href="<?php echo $this->Url(["view" => "create"]); ?>" class="btn" title="Create Pool">Create Pool</a>
<table class="data-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Length</th>
        <th>Address</th>
    </tr>
    </thead>
    <?php foreach($model as $entity): ?>
    <tr onclick="document.location = '<?php echo $this->Url(["view" => "update", "id" => $entity->Name]); ?>';" title="Update">
            <td>
            <?php echo $entity->Name; ?>
            </td>
            <td><?php echo $entity->Length; ?></td>
            <td><?php echo $entity->Address; ?></td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>