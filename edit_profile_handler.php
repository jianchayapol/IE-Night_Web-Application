<?php
session_start();
require("connection.php");


// if ($_POST["username"] != $_SESSION["cus_user"]) {
//     $new_user = $_POST["username"];
//     $check_query = "SELECT * FROM tbl_customers WHERE username = '$new_user'";
//     $check_result = mysqli_query($db, $check_query);
//     if (mysqli_num_rows($check_result) != 0) {
//         header("refresh: 0; url = edit_profile.php");
//     } else {
//         $old_user = $_SESSION["cus_user"];
//         $user = $_POST["username"];
//         $pass = $_POST["password"];
//         $name = $_POST["name"];
//         $surname = $_POST["surname"];
//         $birthdate = $_POST["birthdate"];
//         $gender = $_POST["gender"];
//         $address = $_POST["address"];
//         $occupation = $_POST["occupation"];
//         $tel = $_POST["tel"];
//         $email = $_POST["email"];

//         $query = "UPDATE tbl_customers SET username = '$user', password = '$pass', name = '$name', surname = '$surname', birthdate = '$birthdate', gender = '$gender', address = '$address', occupation = '$occupation', telephone = '$tel', email = '$email' WHERE username = '$old_user'";
//         mysqli_query($db, $query);

//         $_SESSION["cus_user"] = $user;
//         $_SESSION["cus_pass"] = $pass;
//         $_SESSION["cus_name"] = $name;

//         header("refresh: 0; url = profile.php");
//     }

$new_user = $_POST["username"];
$check_query = "SELECT * FROM tbl_customers WHERE username = '$new_user'";
$check_result = mysqli_query($db, $check_query);

if (($_POST["username"] != $_SESSION["cus_user"]) AND (mysqli_num_rows($check_result) != 0)) {
        header("refresh: 0; url = edit_profile.php");    
} else {
    $old_user = $_SESSION["cus_user"];
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $occupation = $_POST["occupation"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];

    $query = "UPDATE tbl_customers SET username = '$user', password = '$pass', name = '$name', surname = '$surname', birthdate = '$birthdate', gender = '$gender', address = '$address', occupation = '$occupation', telephone = '$tel', email = '$email' WHERE username = '$old_user'";
    mysqli_query($db, $query);

    $_SESSION["cus_user"] = $user;
    $_SESSION["cus_pass"] = $pass;
    $_SESSION["cus_name"] = $name;

    header("refresh: 0; url = profile.php");
}

?>