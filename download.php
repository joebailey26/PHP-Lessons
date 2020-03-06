<?php

    if (ctype_digit($_GET["songID"])) {
        $id = $_GET["songID"];

        // Try to do the following code. It might generate an exception (error)
        try {
            require("database_connection.php");

            $statement = $conn->prepare("select * from wadsongs where ID=?");

            $statement->execute([$id]);

            while($row=$statement->fetch()) {
                $downloads = $row["downloads"] + 1;

                // Send an SQL query to the database server
                $statement_two = $conn->prepare("update wadsongs set downloads=? where ID=?");

                $statement_two->execute([$downloads, $id]);

                /* Download file
                    $file_url = 'http://www.myremoteserver.com/file.exe';
                    header('Content-Type: application/octet-stream');
                    header("Content-Transfer-Encoding: Binary"); 
                    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
                    readfile($file_url); 
                */
            }
        }
        // Catch any exceptions (errors) thrown from the 'try' block
        catch(PDOException $e) {
            echo "Error: $e";
        }
    }
    else {
        echo "Don't try to hack this site";
    }
?>