<h2>Player Index</h2>
<a href="<?php echo $this->Url(["view" => "add" ]); ?>">Add</a>
<table>
    <thead>
    <tr>
        <th>Team Name</th>
        <th>Given Name</th>
        <th>Family Name</th>
        <th>Date of Birth</th>
        <th>Handed</th>
        <th></th>
    </tr>
    </thead>
    <?php foreach($model as $entity): ?>
        <tr>
            <td>
                <a href="<?php echo $this->Url(["view" => "detail", "area" => "team", "id" => $entity->TeamName ]); ?>">
                    <?php echo $entity->TeamName; ?>
                </a>
            </td>
            <td><?php echo $entity->GivenName; ?></td>
            <td><?php echo $entity->FamilyName; ?></td>
            <td><?php echo $entity->Dob; ?></td>
            <td><?php echo $entity->Handed; ?></td>
            <td>
                <a href="<?php echo $this->Url(["view" => "update", "id" => $entity->Id ]); ?>">update</a>
                <a href="<?php echo $this->Url(["view" => "delete", "id" => $entity->Id ]); ?>">delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tbody>
    </tbody>
</table>