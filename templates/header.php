<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="/img/favicon.png">

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet"/>

        <? if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?> | FOPortal</title>
        <? else: ?>
            <title>FOPortal</title>
        <? endif ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="js/tinysort.min.js"></script>
        <script src="js/scripts.js"></script>

    </head>

    <body>

        <div class="container">
            <div id="top" class="row">
                <? if (isset($username)): ?>
                    <div id="logo" class="col-md-4 col-md-offset-4">
                        <img src="img/logo.png" alt="logo"><h1><a href="index.php">FOPortal</a><sup>BETA</sup></h1>
                    </div>
                    <div id="controls" class="col-md-4 text-center">welcome <?= $username ?> | <a href="edit.php">edit </a> | <a href="logout.php">log out</a></div>
                <? else: ?>
                    <div id="logo">
                        <img src="img/logo.png" alt="logo"><h1><a href="index.php">FOPortal</a><sup>BETA</sup></h1>
                    </div>
                <? endif ?>
            </div>

            <div id="middle">
