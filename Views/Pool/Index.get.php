<h2>Pool Index</h2>
<a href="<?php echo $this->Url(["view" => "create"]); ?>">Create</a>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Length</th>
        <th>Address</th>
    </tr>
    </thead>
    <?php foreach($model as $entity): ?>
    <tr onclick="document.location = '<?php echo $this->Url(["view" => "detail", "id" => $entity->Name]); ?>';">
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