<?php

function MenuItem($areaName, $areaDescription, $thisContext)
{
    $selected = $thisContext->request["Query"]["area"] === $areaName ? "selected" : "";
    $url = $thisContext->Url(["view" => "index", "area" => $areaName]);
    return "<li class='$selected'><a href='$url'>$areaDescription</a></li>";
}

?>
<!DOCTYPE html>
<html>
    <head>
    <!-- common scripts and styles -->
    <link rel="stylesheet" href="Styles/Common.css" />
    </head>
    <title>Water Hockey - <?php echo $this->title; ?></title>
    <body>
        <div class="nav-bar">
            <ul class="nav">
                <?php echo  MenuItem("team", "Teams", $this); ?>
                <?php echo  MenuItem("game", "Games", $this); ?>
                <?php echo  MenuItem("player", "Players", $this); ?>
                <?php echo  MenuItem("pool", "Pools", $this); ?>
            </ul>
            
        </div>
        <div class="main-container">
            <div class="view-container"><?php include($viewfile); ?></div>
        </div>
    </body>
</html>