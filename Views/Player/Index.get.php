<h1>Player Index</h1>
<a href="<?php echo $this->Url(["view" => "create" ]); ?>" class="btn" title="Create Player">Create Player</a>
<table class="data-table">
    <thead>
    <tr>
        <th>Team Name</th>
        <th>Given Name</th>
        <th>Family Name</th>
        <th>Date of Birth</th>
        <th>Handed</th>
    </tr>
    </thead>
    <?php foreach($model as $entity): ?>
    <tr onclick="document.location = '<?php echo $this->Url(["view" => "update", "id" => $entity->Id]); ?>';" title="Update">
            <td><?php echo $entity->TeamName; ?></td>
            <td><?php echo $entity->GivenName; ?></td>
            <td><?php echo $entity->FamilyName; ?></td>
            <td><?php echo $entity->Dob; ?></td>
            <td><?php echo $entity->Handed; ?></td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>