<?php 

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
    
?>