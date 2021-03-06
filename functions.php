<?php
    session_start();
    function links($title) {
        echo "<style>
            html {
                display: grid;
                height: 100%;
                grid-template-rows: 1fr;
            }
            body {
                display: grid;
                max-width: 780px;
                margin: auto;
                max-height: 80%;
                height: 100%;
                align-items: center;
                grid-template-columns: 1fr .25fr;
                grid-auto-rows: min-content;
            }
            .sidebar {
                grid-column: 2;
                grid-row: 1;
            }
            *:not(body):not(html) {
                grid-column:1;
            }
        </style>";
        if (!$_SESSION["gatekeeper"]) {
            $array = [
                "Home" => "index.php",
                "SignUp" => "signup.php",
                "Login" => "login.php"
            ];
        }
        else if (!$_SESSION["admin"]) {
            $array = [
                "Home" => "index.php",
                "Logout" => "logout.php",
                "Update Password" => "updatepass.php"
            ];
        }
        else {
            $array = [
                "Home" => "index.php",
                "Logout" => "logout.php",
                "Update Password" => "updatepass.php",
                "Update Song" => "updatesong.php"
            ];
        };
        echo "<div class='sidebar'>";
        echo "<h3>".$title."</h3>";
        foreach($array as $i => $item) {
            echo "<a href=\"$array[$i]\">$i</a><br>";
        };
        echo "</div>";
    }
?>