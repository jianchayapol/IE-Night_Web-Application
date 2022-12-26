<?php
session_start();
require("connection.php");

$user = $_POST["username"];
$pass = $_POST["password"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$birthdate = $_POST["birthdate"];
$gender = $_POST["gender"];
$intania = $_POST["intania"];
$address = $_POST["address"];
$road = $_POST["road"];
$district = $_POST["district"];
$county = $_POST["county"];
$province = $_POST["province"];
$zipCode = $_POST["zipCode"];
$occupation = $_POST["occupation"];
$tel = $_POST["tel"];
$email = $_POST["email"];

$query = "SELECT * FROM tbl_customers WHERE username = '$user'";
$result = mysqli_query($db, $query);

if ($list = mysqli_fetch_array($result)) {
    echo '<script type="Text/JavaScript"> 
        alert("Username already taken");
        </script>';
    header("refresh:0; url = signup.php");
} else {
    $query = "INSERT INTO tbl_customers SET username = '$user', password = '$pass', name = '$name', surname = '$surname', birthdate = '$birthdate', gender = '$gender', intania = '$intania', occupation = '$occupation', telephone = '$tel', email = '$email', address = '$address', road = '$road', district = '$district', county = '$county', province = '$province', zip_code = '$zipCode'";
    mysqli_query($db, $query);
    header("refresh: 0; url = login.php");
}
