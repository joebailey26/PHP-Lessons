<?php include("functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>SignUp!</title>
</head>
<body>
    <form method="post" action="signup_results.php">
        <label for="name">Name:</label>
        <input name="name" type="text" required/>
        <br>
        <label for="username">Username:</label>
        <input name="username" type="text" required/>
        <br>
        <label for="day">Day:</label>
        <select name="day" required>
        <?php 
            for ($x = 1; $x <= 31; $x++) {
                echo "<option>$x</option>";
            }
        ?>
        </select>
        <label for="month">Month:</label>
        <select name="month" required>
        <?php 
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

            foreach($array as $i => $item) {
                echo "<option value='$i'>$array[$i]</option>";
            }
        ?>
        </select>
        <label for="year">Year:</label>
        <select name="year" required>
        <?php 
            $date = date("Y") - 18;
            for ($x = 1890; $x <= $date; $x++) {
                echo "<option>$x</option>";
            }
        ?>
        </select>
        <br>
        <label for="password">Password:</label>
        <input name="password" type="password" required/>
        <br>
        <input type="submit" value="Go!" />
    </form>
    <?php links("Signup") ?>
</body>
</html>