<?php
    include("functions.php");
    $type = $_POST["type"];
    $search = $_POST["search"];

    if ($search == "") {
        echo "<p>You did not search for anything</p>";
    }
    else {
        // Try to do the following code. It might generate an exception (error)
        try 
        {
            require("database_connection.php");

            // Send an SQL query to the database server
            $results = $conn->query("select * from songs where $type='$search'");

            $row = $results->fetch(PDO::FETCH_ASSOC);
            if ($row == false) {
                echo "Your search returned no results!";
            }
            else {
                // Loop through the results
                while($row=$results->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<p>";
                    echo " Song Title ". $row["title"] ."<br/> ";
                    echo " Artist " . $row["artist"] . "<br/> " ; 
                    echo " Year " .$row["year"]. "<br/>" ; 
                    echo " Genre " .$row["genre"]. "<br/>" ; 
                    echo "</p>";
                }
            }
        }
        // Catch any exceptions (errors) thrown from the 'try' block
        catch(PDOException $e) 
        {
            echo "Error: $e";
        }
    };    
    links("Search");
?>