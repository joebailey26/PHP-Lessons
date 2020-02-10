<?php 
    include("functions.php");

    $a = $_POST["theArtist"];

    if ($a = "") {
        echo "<p>You did not search for anything</p>";
    }
    else {
        echo "<p>You are searching for songs by $a</p>";

        // Try to do the following code. It might generate an exception (error)
        try 
        {
            require("database_connection.php");

            // Send an SQL query to the database server
            $results = $conn->query("select * from songs where artist='$a'");

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
        // Catch any exceptions (errors) thrown from the 'try' block
        catch(PDOException $e) 
        {
            echo "Error: $e";
        }
    };    
?>