<?php
echo ("<img src = './image/icons/ie-night-head.png' width=50%><br>");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>

<body>
    <fieldset >
        <legend><h2> SIGN UP </h2> </legend>

    <form action="signup_handler.php" method=POST>
        <table>
            <tr>
                <td><label for="username">USERNAME</label></td>
                <td><input type=TEXT name="username" id="username" placeholder="username" required></td>
            </tr>
            <tr>
                <td><label for="password">PASSWORD</label></td>
                <td><input type=password name="password" id="password" placeholder="password" required></td>
            </tr>
            <tr>
                <td><label for="name">NAME</label></td>
                <td><input type=TEXT name="name" id="name" placeholder="name" required></td>
            </tr>
            <tr>
                <td><label for="surname">SURNAME</label></td>
                <td><input type=TEXT name="surname" id="surname" placeholder="surname" required></td>
            </tr>
            <tr>
                <td>BIRTHDATE</td>
                <td><input type=DATE name="birthdate" required></td>
            </tr>
            <tr>
                <td>GENDER</td>
                <td>
                    <input type=RADIO name="gender" value="Male" required>Male
                    <input type=RADIO name="gender" value="Female">Female
                    <input type=RADIO name="gender" value="Not Specified">Not Specified
                </td>
            </tr>
            <tr>
                <td><label for="intania">INTANIA</label></td>
                <td><input type="text" name="intania" id="intania" placeholder="80" pattern="[0-9]{1-3}" required></td>
            </tr>
            <tr>
                <td><label for="address">ADDRESS</label></td>
                <td><input type=TEXT name="address" id="address" placeholder="address" required></td>
                <td><input type=TEXT name="road" id="road" placeholder="road" required></td>
                <td><input type=TEXT name="district" id="district" placeholder="district" required></td>
                <td><input type=TEXT name="county" id="county" placeholder="county" required></td>

            </tr>
            <tr>
                <td></td>
                <td><input type=TEXT name="province" id="province" placeholder="province" required></td>
                <td><input type=TEXT name="zipCode" id="zipCode" placeholder="ZIP CODE" required></td>
            </tr>
            <tr>
                <td><label for="occupation">OCCUPATION</label></td>
                <td><input type=TEXT name="occupation" id="occupation" placeholder="occupation"></td>
            </tr>
            <tr>
                <td><label for="tel">TELEPHONE</label></td>
                <td><input type=TEL name="tel" id="tel" placeholder="0XX-XXX-XXXX" pattern="0[0-9]{2}-[0-9]{3}-[0-9]{4}" required></td>
            </tr>
            <tr>
                <td><label for="email">E-mail</label></td>
                <td><input type=email name="email" id="email" placeholder="" required></td>
            </tr>
        </table>
        <br>
        <input type=SUBMIT value='submit'>
    </form>
</body>

</html>