<?php
echo("<a href = 'homepage_logged.php'><img src = './image/icons/ie-night-head.png' height=100></a><br>");
echo("
    <span class='element'>
        <a href = 'profile.php'>" .$_SESSION["cus_name"]. "</a>
        <a href = 'logoff_handler.php'> log off</a>
    </span>

    <style>
        .element{
            background-color: gainsboro;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            Width:525;
            gap: 16px;
        }
    </style>
    <br>

");
?>


