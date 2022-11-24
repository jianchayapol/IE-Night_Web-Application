<?php
session_start();
require("connection.php");

$cus_user = $_POST["cus_user"];
$cus_pass = $_POST["cus_pass"];

$query = "SELECT * FROM tbl_customers WHERE username = '$cus_user' AND password = '$cus_pass'";
$result = mysqli_query($db, $query);

if ($list = mysqli_fetch_array($result)) {
    $_SESSION['cus_user'] = $list['username'];
    $_SESSION['cus_pass'] = $list['password'];
    $_SESSION['cus_name'] = $list['name'];
    header("refresh: 0; url = homepage_logged.php");
}
else {
    echo '<script type="Text/JavaScript"> 
        alert("Incorrect Username/Password");
        </script>';
    header("refresh: 0; url = login.php");
}
?>