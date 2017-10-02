<h1>
    <span><?php print $this->request["Query"]["view"];?></span>
    [<span><?php print $this->request["Method"];?></span>]
</h1>
<h2>Game with Id '<span><?php echo $model->Id; ?></span>' has been deleted</h2>
<a href="app.php?area=game&view=index">Game Index</a>