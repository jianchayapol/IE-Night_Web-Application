<?php
session_start();
require("check_login.php");
require("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div>
        <h2>IE NIGHT 2022 Ticket</h2>
    </div>
    <div>
        <table>
            <tr>
                <td><img src="./image/merchandises/001" alt="ie night 2022 ticket" height = 100></td>
                <td>
                    <p>detail</p>
                    <a href = "ie_night_detail.php">LEARN MORE</a>
                </td>
            </tr>
        </table>
    </div>
    <!-- <div background-color: gray></div> -->
    <div>
        <h2>MERCHANDISE</h2>
    </div>
    <div>
        <table>
            <tr>
                <td>
                    <img src="./image/merchandises/002" alt="" width = 100 href = "login.php">
                </td>
                <td>
                    <img src="./image/merchandises/003" alt="" width = 100>
                </td>
                <td>
                    <img src="./image/merchandises/004" alt="" width = 100>
                </td>
                <td>
                    <img src="./image/merchandises/005" alt="" width = 100>
                </td>
            </tr>
        </table>
    </div>
    <div><a href="shopping.php">NEXT TO SHOPPING</a></div>
    

    
</body>
</html>
