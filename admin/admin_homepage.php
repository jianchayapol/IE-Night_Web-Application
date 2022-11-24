<?php
session_start();
require("admin_check_login.php");
require("admin_header.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
</head>
<body>
    <br>
    <table>
        <tr>
            <td><a href="manage_staff.php">All Staff</a></td>
        </tr>
        <tr>
            <td><a href="manage_order.php">All Orders</a></td>
        </tr>
        <tr>
            <td><a href="manage_merchandise">All Merchandises</a></td>
        </tr>
    </table>
</body>
</html>