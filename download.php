<?php
    $id = $_GET["songID"];

    // Try to do the following code. It might generate an exception (error)
    try {
        require("database_connection.php");

        $results = $conn->query("select * from wadsongs where ID='$id'");

        $row = $results->fetch(PDO::FETCH_ASSOC);

        $downloads = $row["downloads"] - 1;

        // Send an SQL query to the database server
        $conn->query("update wadsongs set downloads='$downloads' where ID='$id'");

        /* Download file
            $file_url = 'http://www.myremoteserver.com/file.exe';
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
            readfile($file_url); 
        */
    }
    // Catch any exceptions (errors) thrown from the 'try' block
    catch(PDOException $e) {
        echo "Error: $e";
    }
?>