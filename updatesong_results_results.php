<?php
    if (ctype_digit($_POST["id"]) && ctype_digit($_POST["id"]) && ctype_digit($_POST["id"])) {
        include("functions.php");
        $id = $_POST["id"];
        $price = $_POST["price"];
        $chart_position = $_POST["chart_position"];

        // Try to do the following code. It might generate an exception (error)
        try 
        {
            require("database_connection.php");

            $statement = $conn->query("update wadsongs set price=?, chart=? where id=?");

            $statement->execute([$price, $chart_position, $id]);

            echo "<p>Details updated successfully</p>";
        }
        // Catch any exceptions (errors) thrown from the 'try' block
        catch(PDOException $e) 
        {
            echo "Error: $e";
        };   
        links("Update Song");
    }
    else {
        echo "Don't try to hack this site";
    }
?>