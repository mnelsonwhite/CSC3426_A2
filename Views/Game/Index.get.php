
<h2>Game Index</h2>
<a href="<?php echo $this->Url(["view" => "create"]); ?>">Create</a>
<table>
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
    <?php foreach($model as $entity): ?>
        <tr onclick="document.location = '<?php echo $this->Url(["view" => "detail", "id" => $entity->Id]); ?>';">
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