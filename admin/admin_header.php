<?php

echo("<a href = 'homepage_logged.php'><img src = '../image/icons/ie-night-head.png' height=100 ></a><br>");

echo("
    <div class=element>
        Admin: <a href='admin_homepage.php'>" .$_SESSION['admin_name']. "</a> 
        <a class='button is-primary' href='admin_logoff_handler.php'>log off</a>
        <a href='admin_homepage.php'> Back </a> 
    </div>

    <style>
        .element{
        background-color: LIGHTGRAY;
        padding: 10px;
        display: flex;
        flex-wrap: wrap;
        Width:525;
        gap: 16px;

        }
    </style>
    ");



?>