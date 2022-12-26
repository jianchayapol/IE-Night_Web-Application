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
    <title>Edit Profile</title>
</head>

<body>
    <div>
        <h1>EDIT INFO</h1>
    </div>
    <?php
    require("connection.php");
    $user = $_SESSION["cus_user"];
    $query = "SELECT * FROM tbl_customers WHERE username = '$user'";
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
    <form action="edit_profile_handler.php" method=POST>
        <table>
            <tr>
                <td><label for="username">USERNAME: </label></td>
                <td><input type="text" name=username id="username" value="<?php echo ($username) ?>" placeholder="username" required></td>
            </tr>
            <tr>
                <td><label for="password">PASSWORD: </label></td>
                <td><input type="text" name=password id="password" value="<?php echo ($password) ?>" placeholder="password" required></td>
            </tr>
            <tr>
                <td><label for="name">NAME: </label></td>
                <td><input type="text" name=name id="name" value="<?php echo ($name) ?>" placeholder="name" required></td>
            </tr>
            <tr>
                <td><label for="surname">SURNAME: </label></td>
                <td><input type="text" name=surname id="surname" value="<?php echo ($surname) ?>" placeholer="surname" required></td>
            </tr>
            <tr>
                <td><label for="birthdate">BIRTHDATE: </label></td>
                <td><input type="date" name=birthdate id="birthdate" value="<?php echo ($birthdate) ?>" required></td>
            </tr>
            <tr>
                <td>GENDER: </td>
                <?php
                if ($gender == "Male") {
                    echo ("<td><input type='radio' name = gender id='male' value='Male' checked required><label for='male'>Male</label>
                                   <input type='radio' name = gender id='female' value='Female'><label for='female'>Female</label>
                                   <input type='radio' name = gender id='not_specified' value='Not Specified'><label for='not_specified'>Not Specified</label></td>");
                } elseif ($gender == "Female") {
                    echo ("<td><input type='radio' name = gender id='male' value='Male' required><label for='male'>Male</label>
                                   <input type='radio' name = gender id='female' value='Female' checked><label for='female'>Female</label>
                                   <input type='radio' name = gender id='not_specified' value='Not Specified'><label for='not_specified'>Not Specified</label></td>");
                } else {
                    echo ("<td><input type='radio' name = gender id='male' value='Male' required><label for='male'>Male</label>
                                   <input type='radio' name = gender id='female' value='Female'><label for='female'>Female</label>
                                   <input type='radio' name = gender id='not_specified' value='Not Specified' checked><label for='not_specified'>Not Specified</label></td>");
                }
                ?>
            </tr>
            <tr>
                <td><label for="intania">INTANIA: </label></td>
                <td><input type="text" name="intania" id="intania" value="<?php echo ($intania) ?>" pattern="[0-9]{1-3}" required></td>
            </tr>
            <tr>
                <td><label for="address">ADDRESS</label></td>
                <td><input type=TEXT name="address" id="address" value="<?php echo ($address) ?>"></td>
                <td><input type=TEXT name="road" id="road" value="<?php echo ($road) ?>" ></td>
                <td><input type=TEXT name="district" id="district" value="<?php echo ($district) ?>"></td>
                <td><input type=TEXT name="county" id="county" value="<?php echo ($county) ?>"></td>

            </tr>
            <tr>
                <td></td>
                <td><input type=TEXT name="province" id="province" value="<?php echo ($province) ?>"></td>
                <td><input type=TEXT name="zipCode" id="zipCode" value="<?php echo ($zipCode) ?>"></td>
            </tr>
            <!-- <tr>
                <td><label for="address">ADDRESS: </label></td>
                <td><textarea name=address id="address"><?php echo ($address) ?></textarea></td>
            </tr> -->
            <tr>
                <td><label for="occupation">OCCUPATION: </label></td>
                <td><input type="text" name=occupation id="occupation" value="<?php echo ($occupation) ?>"></td>
            </tr>
            <tr>
                <td><label for="tel">PHONE NUMBER: </label></td>
                <td><input type="tel" name=tel id="tel" value="<?php echo ($tel) ?>" placeholder="0XX-XXX-XXXX" pattern="0[0-9]{2}-[0-9]{3}-[0-9]{4}" required></td>
            </tr>
            <tr>
                <td><label for="email">E-mail: </label></td>
                <td><input type="email" name=email id="email" value="<?php echo ($email) ?>" required></td>
            </tr>
        </table>
        <!-- <a href="profile.php"><input type="submit" value="Back"></a> -->
        <input type="submit" value="Submit">
    </form>


</body>

</html>