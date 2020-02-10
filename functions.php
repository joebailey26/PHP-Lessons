<?php
    require("vendor/autoload.php");
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    function links() {
        $array = [
            "Index" => "index.php",
            "SignUp" => "signup.php",
        ];

        foreach($array as $i => $item) {
            echo "<a href=\"$array[$i]\">$i</a><br>";
        };
    }
    function db() {
        $db_host = getenv('DATABASE_HOST');
        $db_name = getenv('DATABASE_NAME');
        $db_user = getenv('DATABASE_USER');
        $db_pass = getenv('DATABASE_PASS');

        // Connect to the database
        return new PDO ("mysql:host=$db_host;dbname=$db_name;", $db_name, $db_pass);
    }
?>