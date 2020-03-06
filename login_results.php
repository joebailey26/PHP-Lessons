<?php 
    session_start();

    if (ctype_alnum($_POST["username"]) && ctype_alnum($_POST["password"])) {
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

                if ($results->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION["gatekeeper"] = $username;
                    while($row=$results->fetch(PDO::FETCH_ASSOC)) {
                        print_r($row["isadmin"]);
                        if ($row["isadmin"] == 1) {
                            $_SESSION["admin"] = $row["isadmin"];
                        };
                    };
                    // header("Location: index.php");
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
    }
    else {
        echo "Don't try to hack this site";
    }
?>