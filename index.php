<?php
    include("functions.php"); 

    if (!$_SESSION["gatekeeper"]) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>HitTastic!</title>
    </head>
    <body>
    <?php
        if ($_SESSION["gatekeeper"]) {
            $username = $_SESSION["gatekeeper"];
            // Try to do the following code. It might generate an exception (error)
            try 
            {
                require("database_connection.php");

                // Send an SQL query to the database server
                $results = $conn->query("select * from ht_users where username='$username'");

                $row = $results->fetch(PDO::FETCH_ASSOC);
                echo '<h2>Welcome Back '.$username.'. Your balance is £'.$row["balance"].'</h2>';
            }
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
            }
        }
    ?>
        <h1>HitTastic!</h1>
        <p>Search and download your favorite 40 hits on
        HitTastic! Whether it's pop, rock, rap, or pure liquid
        cheese you're into, you can be sure to find it on
        HitTastic! With the full range of top 40 hits from the
        past 60 years on our database, you can guarantee you'll
        find what you're looking for. Plus with our Year Search
        (coming soon!) find out exactly what was in the chart in
        any year in the past 60 years. </p>
        <form method="post" action="search_results.php">
                <label>Please enter an artist:</label>
                <input name="theArtist" required />
                <input type="submit" value="Go!" />
        </form>
        <form method="post" action="search_results_alt.php">
                <label for="type">Please choose how you want to search</label>
                <select name="type">
                    <?php 
                        $array = [
                            "1" => "Year",
                            "2" => "Title",
                            "3" => "Artist",
                        ];

                        foreach($array as $i => $item) {
                            echo "<option>$array[$i]</option>";
                        }
                    ?>
                </select>
                <br/>
                <label for="search">Please search:</label>
                <input name="search" required />
                <input type="submit" value="Go!" />
        </form>
        <?php links("Home") ?>
    </body>
</html>