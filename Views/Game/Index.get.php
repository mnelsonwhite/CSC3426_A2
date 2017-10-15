
<h1>Game Index</h1>
<a href="<?php echo $this->Url(["view" => "create"]); ?>" class="btn" title="Create Game">Create Game</a>
<table class="data-table">
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
        <tr onclick="document.location = '<?php echo $this->Url(["view" => "update", "id" => $entity->Id]); ?>';" title="Update">
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