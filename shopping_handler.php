<?php
// print_r($_POST);
// print_r($_POST["id_quantity"]);
// print_r(array_diff($_POST["id_quantity"], array(0)));

session_start();
require("connection.php");

$available = TRUE;

$real_mer = array_diff($_POST["id_quantity"], array(0));
foreach ($real_mer as $mer_id => $quantity) {
    $check_query = "SELECT * FROM tbl_merchandises WHERE id = '$mer_id'";
    $check_result = mysqli_query($db, $check_query);
    if ($check_list = mysqli_fetch_array($check_result)) {
        if ($check_list["stock"] < $quantity) {
            $available = FALSE;
            $name = $check_list["name"];
            $stock = $check_list["stock"];
            echo "<script type='text/javascript'>alert('$name out-of-stock! (in-stock:$stock)');</script>";
            header("refresh: 0; url=shopping.php");
        }
    }
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}
if ($available) {
    $_SESSION["cart"] = array_diff($_POST["id_quantity"], array(0));
    if (count($_SESSION["cart"]) == 0) {
        echo "<script type='text/javascript'>alert('No ITEM Selected');</script>";
        header("refresh: 0; url=shopping.php");
    } else if (isset($_POST["payment"])) {
        header("refresh: 0; url=payment.php");
    } else {
        header("refresh: 0; url=cart.php");
    }
    // print_r($_SESSION["cart"]);
}
