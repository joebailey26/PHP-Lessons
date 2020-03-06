<?php
    if (ctype_alnum($_POST["username"]) && ctype_alnum($_POST["newpassword"])) {
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
                $statement = $conn->prepare("select * from ht_users where username=?");

                $statement->execute([$username]);

                if ($statement->fetch() == false) {
                    echo "That user doesn't exist";
                }
                else {
                    $statement_two = $conn->query("update ht_users set password=? where username=?");

                    $statement_two->execute([$newpassword, $username]);
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
    }
    else {
        echo "Don't try to hack this site";
    }
?>