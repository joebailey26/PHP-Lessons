<?php
function links() {
    $array = [
        "Index" => "index.php",
        "SignUp" => "signup.php",
    ];

    foreach($array as $i => $item) {
        echo "<a href=\"$array[$i]\">$i</a><br>";
    };
}
?>