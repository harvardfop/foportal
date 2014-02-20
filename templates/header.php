<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/styles.css" rel="stylesheet"/>

        <? if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?> | FOPortal</title>
        <? else: ?>
            <title>FOPortal</title>
        <? endif ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>

    </head>

    <body>

        <div class="container">
            <div class="row">
                <? if (isset($username)): ?>
                    <div id="top" class="col-md-4 col-md-offset-4">
                        <h1><a href="/">FOPortal</a></h1>
                    </div>
                    <div id="controls" class="col-md-4">welcome <a href="/edit.php"><?= $username ?></a> | <a href="/logout.php">log out</a></div>
                <? else: ?>
                    <div id="top">
                        <h1><a href="/">FOPortal</a></h1>
                    </div>
                <? endif ?>
            </div>

            <div id="middle">
