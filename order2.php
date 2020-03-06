<?php 
    if (ctype_digit($_POST["songID"]) && ctype_digit($_POST["qty"])) {
        include("functions.php");
        $id = $_POST["songID"];
        $qty = $_POST["qty"];

        // Try to do the following code. It might generate an exception (error)
        try 
        {
            require("database_connection.php");

            $statement = $conn->prepare("select * from wadsongs where id=?");

            $statement->execute([$id]);

            while($row=$statement->fetch()) {
                if ($row["qty"] < $qty) {
                    echo "<p>Not enough stock</p>";
                }
                else {
                    $new_qty = $row["qty"] - $qty;

                    // Send an SQL query to the database server
                    $statement_two = $conn->prepare("update songs set qty=? where id=?");

                    $statement_two->execute([$new_qty, $id]);

                    echo "<p>Order placed.</p>";
                }
            }
        }
        // Catch any exceptions (errors) thrown from the 'try' block
        catch(PDOException $e) 
        {
            echo "Error: $e";
        }
        links("Order");
    }
    else {
        echo "Don't try to hack this site";
    }
?>