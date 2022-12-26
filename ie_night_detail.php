<?php
session_start();
require("check_login.php");
require("header.php");
require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IE NIGHT</title>
</head>
<body>
    <div>
        <h1>What is IE NIGHT?</h1>
    </div>
    <div>
        <div>
            <img src="./image/icons/ie_night.jpg" width = 200 alt="ie night">
            <img src="./image/merchandises/35.jpg" width = 200 alt="ie night">
        </div>
        <div>
            <p>IE NIGHT is an one-night event for current students and alumni for Industrial Engineering,Chulalongkorn University.<br>
            This event is use to celebrate 80th aniversary of this department. This event will consist of :<br>
            - networking session <br>
            - celebration <br>
            - after-party <br>
            <br><h4>click to see <a style='color:blue' href='./stats.php'> Statistics </a></h4><br>
            <h3>SEE YOU ON 4.2.2023</h3>
            </p>
        </div>
    </div>


    <form action = "merchandise1.php" method = POST>
        <input type="submit" value = "buy ticket now" style="background-color: #FFD300 ; color:blue; size: 40px;" >
    </form>

    <div>
        <a style="color:blue" href="homepage_logged.php">Back</a>
    </div>
</body>
</html>