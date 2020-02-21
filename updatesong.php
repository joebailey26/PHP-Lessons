<?php

    if (!$_SESSION["gatekeeper"] || !$_SESSION["admin"]) {
        header("Location: login.php");
    }

    include("functions.php"); 

?>
<html>
    <head>
        <title>Change details of existing song</title>
    </head>
    <body>
        <h1>Change details of an existing song</h1>
        <form method="post" action="updatesong_results.php">
            <label for="id">ID of song: </label>
            <input name="id" type="number" />
            <br>
            <input type="submit" value="Go!" />
        </form>
        <?php links("Update Song") ?>
    </body>
</html>