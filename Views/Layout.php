<!DOCTYPE html>
<html>
    <head>
    <!-- common scripts and styles -->
    <link rel="stylesheet" href="Styles/Common.css" />
    </head>
    <title>Water Hockey - <?php echo $this->title; ?></title>
    <body>
    <?php if ($this->IsAuthenticated()): ?>
        <span class="login-welcome">Welcome <span class="login-name"><?php echo $this->UserName(); ?></span></span>
    <?php endif; ?>
    <h1><a href="app.php" title="Home">Water Hockey</a></h1>
    <div class="view-container"><?php include($viewfile); ?></div>
    </body>
</html>