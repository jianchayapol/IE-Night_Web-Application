<?php
session_start();
require("../connection.php");

$admin_user = $_POST["admin_user"];
$admin_pass = $_POST["admin_pass"];

$query = "SELECT * FROM tbl_admins WHERE username = '$admin_user' AND password = '$admin_pass'";
$result = mysqli_query($db, $query);
if($list = mysqli_fetch_array($result)) {
    $_SESSION["admin_user"] = $list["username"];
    $_SESSION["admin_pass"] = $list["password"];
    $_SESSION["admin_name"] = $list["name"];

    header("refresh: 0; url = admin_homepage.php");
} else {
    header("refresh: 0; url = admin_login.php");
}

?>