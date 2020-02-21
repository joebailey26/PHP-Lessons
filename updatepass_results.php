<?php
    include("functions.php");
    $username = $_POST["username"];
    $newpassword = $_POST["newpassword"];

    if ($username == "" OR $newpassword == "") {
        echo "<p>You did not enter anything</p>";
    }
    else {
        // Try to do the following code. It might generate an exception (error)
        try 
        {
            require("database_connection.php");

            // Send an SQL query to the database server
            $results = $conn->query("select * from ht_users where username='$username'");

            if ($results->fetch(PDO::FETCH_ASSOC) == false) {
                echo "That user doesn't exist";
            }
            else {
                $conn->query("update ht_users set password='$newpassword' where username='$username'");
                echo "<p>Password updated successfully</p>";
            }
        }
        // Catch any exceptions (errors) thrown from the 'try' block
        catch(PDOException $e) 
        {
            echo "Error: $e";
        }
    };    
    links("Update Password");
?>