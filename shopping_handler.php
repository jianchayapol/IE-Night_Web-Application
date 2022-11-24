<?php
    //print_r($_POST);
    //print_r($_POST["id_quantity"]);

    session_start();
    require("connection.php");

    if(!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }

    $_SESSION["cart"] = array_diff($_POST["id_quantity"], array(0));
    if (count($_SESSION["cart"]) == 0) {
        echo "<script type='text/javascript'>alert('No ITEM Selected');</script>";
        header("refresh: 0; url=shopping.php");
    } else if(isset($_POST["payment"])) {
        header("refresh: 0; url=payment.php");
    } else {
        header("refresh: 0; url=cart.php");
    }
    //print_r($_SESSION["cart"]);

?>