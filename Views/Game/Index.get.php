<?php
$baseUrl = "app.php?area=game";

function editUrl($id, $baseUrl)
{
    return "$baseUrl&view=update&id=$id";
}

function deleteUrl($id, $baseUrl)
{
    return "$baseUrl&view=delete&id=$id";
}

function addUrl($baseUrl)
{
    return "$baseUrl&view=add";
}
?>
<h2>Games Index</h2>
<a href="<?php echo addUrl($baseUrl); ?>">Add</a>
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
    <?php foreach($model as $game): ?>
        <tr>
            <td><?php echo $game->TeamAName; ?></td>
            <td><?php echo $game->TeamBName; ?></td>
            <td><?php echo $game->PoolName; ?></td>
            <td><?php echo $game->ScoreA; ?></td>
            <td><?php echo $game->ScoreB; ?></td>
            <td><?php echo $game->Date; ?></td>
            <td>
                <a href="<?php echo editUrl($game->Id, $baseUrl); ?>">update</a>
                <a href="<?php echo deleteUrl($game->Id, $baseUrl); ?>">delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>