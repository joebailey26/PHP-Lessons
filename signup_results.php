<?php 
    include("functions.php");

    $name = $_POST["name"];
    $username = $_POST["username"];
    $day = $_POST["day"];
    $month = $_POST["month"];
    $year = $_POST["year"];

    echo "You have signed up with:";
    echo "<p>Name: $name</p>";
    echo "<p>Username: $username</p>";

    if ($year < 1890) {
        echo "Year is invalid";
    }
    else {
        echo "<p>Date of Birth: $day / $month / $year</p>";
    }

    // Try to do the following code. It might generate an exception (error)
    try 
    {
        db();
        
        // Set up exception-based error handling
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Send an SQL query to the database server
        $results = $conn->query("insert into ht_users (name, username, dob) values ($name, $username, $day + '/' + $month + '/' + $year)" );

        // Loop through the results
        echo "<p>";
        echo " User created successfully ";
        echo "</p>";
    }
    // Catch any exceptions (errors) thrown from the 'try' block
    catch(PDOException $e) 
    {
        echo "Error: $e";
    }
    
?>