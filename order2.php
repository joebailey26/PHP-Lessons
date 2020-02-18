<?php 
    include("functions.php");
    $id = $_POST["songID"];
    $qty = $_POST["qty"];

    // Try to do the following code. It might generate an exception (error)
    try 
    {
        require("database_connection.php");

        $results = $conn->query("select * from songs where id='$id'");

        $row = $results->fetch(PDO::FETCH_ASSOC);

        if ($row["qty"] < $qty) {
            echo "<p>Not enough stock</p>";
        }
        else {
            $new_qty = $row["qty"] - $qty;

            // Send an SQL query to the database server
            $conn->query("update songs set qty='$new_qty' where id='$id'");

            echo "<p>Order placed.</p>";
        }
    }
    // Catch any exceptions (errors) thrown from the 'try' block
    catch(PDOException $e) 
    {
        echo "Error: $e";
    }
    links("Order");
?>