<?php 
    if (ctype_digit($_GET["songID"])) {
        include("functions.php");
        $id = $_GET["songID"];

        try {
            require("database_connection.php");

            // Send an SQL query to the database server
            $results = $conn->query("select * from wadsongs where id='$id'");
            // Loop through the results
            while($row=$results->fetch(PDO::FETCH_ASSOC)) {
                echo "<p>";
                echo " Song Title ". $row["title"] ."<br/> ";
                echo " Artist " . $row["artist"] . "<br/> " ; 
                echo " Year " .$row["year"]. "<br/>" ; 
                echo " Genre " .$row["genre"]. "<br/>" ;
                echo "</p>";
            }
        }
        // Catch any exceptions (errors) thrown from the 'try' block
        catch(PDOException $e) {
            echo "Error: $e";
        }

        echo "<form action='order2.php' method='post'>";
        echo "<input type='number' placeholder='Quantity' name='qty'/>";
        echo "<input type='number' name='songID' value='".$id."'hidden/>";
        echo "<input type='submit' value='Order'/>";
        echo "</form>";
        links("Order");
    }
    else {
        echo "Don't try to hack this site";
    }
?>