<?php
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
            $results = $conn->query("select * from songs where id='$id'");

            $row = $results->fetch(PDO::FETCH_ASSOC);
            if ($row == false) {
                echo "Your search returned no results!";
            }
            else {
                echo "<form method='post' action='updatesong_results_results.php'>";
                echo "<label for='chart_position'>Chart Position</label>";
                echo "<input name='chart_position' value='" . $row["chart_position"] . "' />";
                echo "<label for='price'>Price</label>";
                echo "<input name='price' value='" . $row["price"] . "' />";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
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
?>