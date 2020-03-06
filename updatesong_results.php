<?php
    if (ctype_digit($_POST["id"])) {
        include("functions.php");
        $id = $_POST["id"];

        if ($id == "") {
            echo "<p>You did not enter anything</p>";
        }
        else {
            // Try to do the following code. It might generate an exception (error)
            try 
            {
                require("database_connection.php");

                // Send an SQL query to the database server
                $results = $conn->query("select * from wadsongs where id='$id'");

                if ($results->fetch(PDO::FETCH_ASSOC) == false) {
                    echo "Your search returned no results!";
                }
                else {
                    echo "<form method='post' action='updatesong_results_results.php'>";
                    echo "<label for='chart_position'>Chart Position</label>";
                    echo "<input name='chart_position' value='" . $row["chart_position"] . "' /><br/>";
                    echo "<label for='price'>Price</label>";
                    echo "<input name='price' value='" . $row["price"] . "' /><br/>";
                    echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
                    echo "<input type='submit'/>";
                    echo "</form>";
                }
            }
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
            }
        };
        links("Update Song");
    }
    else {
        echo "Don't try to hack this site";
    }
?>