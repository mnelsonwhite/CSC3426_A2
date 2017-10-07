<h2>Game Index</h2>
<a href="<?php echo $this->Url(["view" => "add"]); ?>">Add</a>
<table>
    <thead>
    <tr>
        <th>Team A Name</th>
        <th>Team B Name</th>
        <th>Pool Name</th>
        <th>Score A</th>
        <th>Score B</th>
        <th>Date</th>
        <th></th>
    </tr>
    </thead>
    <?php foreach($model as $entity): ?>
        <tr>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "area" => "team", "id" => $entity->TeamAName ]); ?>">
                    <?php echo $entity->TeamAName; ?>
                </a>
            </td>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "area" => "team", "id" => $entity->TeamBName ]); ?>">
                    <?php echo $entity->TeamBName; ?>
                </a>
            </td>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "area" => "pool", "id" => $entity->PoolName ]); ?>">
                    <?php echo $entity->PoolName; ?>
                </a>
            </td>
            <td><?php echo $entity->ScoreA; ?></td>
            <td><?php echo $entity->ScoreB; ?></td>
            <td><?php echo $entity->Date; ?></td>
            <td>
                <a href="<?php echo $this->Url(["view" => "update", "id" => $entity->Id ]); ?>">update</a>
                <a href="<?php echo $this->Url(["view" => "delete", "id" => $entity->Id ]); ?>">delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>