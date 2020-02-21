<?php
    include("functions.php");
    $array = [
        "1" => "January",
        "2" => "February",
        "3" => "March",
        "4" => "April",
        "5" => "May",
        "6" => "June",
        "7" => "July",
        "8" => "August",
        "9" => "September",
        "10" => "October",
        "11" => "November",
        "12" => "December",
    ];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $day = $_POST["day"];
    $month = $_POST["month"];
    $year = $_POST["year"];
    $dob = $day . '/' . $array[$month] . '/' . $year;
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
        $conn->query("insert into ht_users (name, username, dayofbirth, monthofbirth, yearofbirth, password) values ('$name', '$username', '$day', '$month', '$year', '$pass')" );

        // Loop through the results
        echo "<p>";
        echo " User created successfully ";
        echo "</p>";
    }
    // Catch any exceptions (errors) thrown from the 'try' block
    catch(PDOException $e) {
        echo "Error: $e";
    };
    links("Signup");
?>