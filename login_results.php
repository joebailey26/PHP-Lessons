<?php 
    session_start();

    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($_SESSION["gatekeeper"] == $username) {
        header("Location: index.php");
    }
    else {
        // Try to do the following code. It might generate an exception (error)
        try {
            require("database_connection.php");

            $results = $conn->query("select * from ht_users where username='$username' AND password='$password'");

            $row = $results->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $_SESSION["gatekeeper"] = $username;
                if ($row["admin"] == 1) {
                    $_SESSION["admin"] = $row["admin"];
                }
                header("Location: index.php");
            }
            else {
                echo "Try again";
            }

        }
        // Catch any exceptions (errors) thrown from the 'try' block
        catch(PDOException $e) {
            echo "Error: $e";
        }
    }
?>