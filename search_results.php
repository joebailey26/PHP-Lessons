<?php
    if (ctype_alnum($_POST["theArtist"])) {
        include("functions.php"); 

        $a = $_POST["theArtist"];

        if ($a == "") {
            echo "<p>You did not search for anything</p>";
        }
        else {
            // Try to do the following code. It might generate an exception (error)
            try 
            {
                require("database_connection.php");

                // Send an SQL query to the database server
                $statement = $conn->prepare("select * from wadsongs where artist=?");

                $statement->execute([$a]);

                if (!$statement->fetch()) {
                    echo "Your search returned no results!";
                }
                else {
                    echo "<p>You are searching for songs by $a</p>";
                    // Loop through the results
                    while($row=$statement->fetch()) {
                        echo "<p>";
                        echo " Song Title ". $row["title"] ."<br/> ";
                        echo " Artist " . $row["artist"] . "<br/> " ; 
                        echo " Year " .$row["year"]. "<br/>" ; 
                        echo " Genre " .$row["genre"]. "<br/>" ; 
                        echo "<a href='download.php?songID=". $row["ID"] ."'>Download this hit</a><br/>";
                        echo "<a href='https://www.youtube.com/results?search_query=" . $row["title"] . "+" . $row["artist"] . "'>Watch on YouTube</a><br/>";
                        echo "<a href='order1.php?songID=" . $row["ID"] . "'>Order this hit</a><br/>";
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
    }
    else {
        echo "Don't try to hack this site";
    }
?>