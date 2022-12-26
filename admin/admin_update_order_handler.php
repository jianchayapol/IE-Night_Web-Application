<?php
session_start();
require("../connection.php");

$payment_unchecked = "(".implode(", ", $_POST["payment_added_id"]).")";
$query1 = "UPDATE tbl_orders 
            SET payment_status = 0 WHERE id NOT IN $payment_unchecked";
mysqli_query($db, $query1);

$payment_checked = "(".implode(", ", $_POST["payment_added_id"]).")";
$query2 = "UPDATE tbl_orders 
            SET payment_status = 1 WHERE id IN $payment_checked";
mysqli_query($db, $query2);

$shipping_unchecked = "(".implode(", ", $_POST["shipping_added_id"]).")";
$query3 = "UPDATE tbl_orders 
            SET shipping_status = 0 WHERE id NOT IN $shipping_unchecked,
            SET shipping_date = "-" WHERE id NOT IN $shipping_unchecked,";
mysqli_query($db, $query3);

$shipping_checked = "(".implode(", ", $_POST["shipping_added_id"]).")";
$query4 = "UPDATE tbl_orders 
            SET shipping_status = 1 WHERE id IN $shipping_checked";
mysqli_query($db, $query4);

echo '<script type="Text/JavaScript"> 
            alert("Updated!");
            </script>';

header("refresh: 0; url=manage_order.php");

?>