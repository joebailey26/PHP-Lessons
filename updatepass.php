<?php
    include("functions.php");

    if (!$_SESSION["gatekeeper"] || !$_SESSION["admin"]) {
        header("Location: login.php");
    }

?>
<html>
    <head>
        <title>Change password</title>
    </head>
    <body>
        <h1>Update a password</h1>
        <form method="post" action="updatepass_results.php">
            <label for="username">Username:</label>
            <input name="username" required />
            <br>
            <label for="newpassword">New password:<label>
            <input name="newpassword" type="password" required />
            <br>
            <input type="submit" value="Go!"/>
        </form>
        <?php links("Update Password") ?>
    </body>
</html>
