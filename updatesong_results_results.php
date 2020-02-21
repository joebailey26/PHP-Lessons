<?php
    include("functions.php");
    $id = $_POST["id"];
    $price = $_POST["price"];
    $chart_position = $_POST["chart_position"];

    // Try to do the following code. It might generate an exception (error)
    try 
    {
        require("database_connection.php");

        $conn->query("update wadsongs set price='$price', chart='$chart_position' where id='$id'");
        echo "<p>Details updated successfully</p>";
    }
    // Catch any exceptions (errors) thrown from the 'try' block
    catch(PDOException $e) 
    {
        echo "Error: $e";
    };   
    links("Update Song");
?>