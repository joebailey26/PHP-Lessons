<?php
    $name = $_POST["name"];
    $username = $_POST["username"];
    $day = $_POST["day"];
    $month = $_POST["month"];
    $year = $_POST["year"];
    $dob = $day . '/' . $month . '/' . $year;
    $pass = $_POST["password"];

    echo "You have signed up with:";
    echo "<p>Name: $name</p>";
    echo "<p>Username: $username</p>";

    if ($year < 1890) {
        echo "Year is invalid";
    }
    else {
        echo "<p>Date of Birth: $dob</p>";
    };

    // Try to do the following code. It might generate an exception (error)
    try {
        require("database_connection.php");

        // Send an SQL query to the database server
        $results = $conn->query("insert into ht_users (name, username, dob, password) values ('$name', '$username', '$dob', '$pass)" );

        // Loop through the results
        echo "<p>";
        echo " User created successfully ";
        echo "</p>";
    }
    // Catch any exceptions (errors) thrown from the 'try' block
    catch(PDOException $e) {
        echo "Error: $e";
    };
    
?>