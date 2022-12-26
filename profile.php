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
    <title>Profile</title>
</head>

<body>
    <div>
        <h1>PROFILE</h1>
    </div>
    <?php
    require("connection.php");
    $cus_user = $_SESSION["cus_user"];
    $query = "SELECT * FROM tbl_customers WHERE username = '$cus_user'";
    $result = mysqli_query($db, $query);

    if ($list = mysqli_fetch_array($result)) {
        $username = $list["username"];
        $password = $list["password"];
        $name = $list["name"];
        $surname = $list["surname"];
        $birthdate = $list["birthdate"];
        $gender = $list["gender"];
        $intania = $list["intania"];
        $address = $list["address"];
        $road = $list["road"];
        $district = $list["district"];
        $county = $list["county"];
        $province = $list["province"];
        $zipCode = $list["zip_code"];
        $occupation = $list["occupation"];
        $tel = $list["telephone"];
        $email = $list["email"];
    }
    ?>
    <table>
        <tr>
            <td>USERNAME: </td>
            <td><?php echo ($username) ?></td>
        </tr>
        <tr>
            <td>PASSWORD: </td>
            <td><?php
                for ($i = 0; $i < strlen($password); $i++) {
                    echo "*";
                }  ?></td>
        </tr>
        <tr>
            <td>NAME: </td>
            <td><?php echo ($name) ?></td>
        </tr>
        <tr>
            <td>SURNAME: </td>
            <td><?php echo ($surname) ?></td>
        </tr>
        <tr>
            <td>BIRTHDATE: </td>
            <td><?php echo ($birthdate) ?></td>
        </tr>
        <tr>
            <td>GENDER: </td>
            <td><?php echo ($gender) ?></td>
        </tr>
        <tr>
            <td>INTANIA: </td>
            <td><?php echo ($intania) ?></td>
        </tr>
        <tr>
            <td>ADDRESS: </td>
            <td><?php echo ($address. " " .$road. " " . $district. " " . $county. " " . $province. " " . $zipCode) ?></td>
        </tr>
        <tr>
            <td>OCCUPATION: </td>
            <td><?php echo ($occupation) ?></td>
        </tr>
        <tr>
            <td>TELEPHONE: </td>
            <td><?php echo ($tel) ?></td>
        </tr>
        <tr>
            <td>E-mail: </td>
            <td><?php echo ($email) ?></td>
        </tr>
    </table>

    <br><br>
    <span><a href="order_history.php"><input type="submit" value="ORDER HISTORY"></a></span>
    <span><a href="homepage_logged.php"><input type="submit" value="BACK TO HOMEPAGE"></a></span>
    <span><a href="edit_profile.php"><input type="submit" value="EDIT PROFILE"></a></span>


</body>

</html>