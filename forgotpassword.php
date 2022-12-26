<?php
echo("<img src = './image/icons/ie-night-head.png' width=50%><br>");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>
<body>
    <div><h2>FORGOT PASSWORD</h2></div>

    <form action = "forgotpassword_handler.php" method = POST>
        <table>
            <tr>
                <td><label for="username">USERNAME: </label></td> 
                <td><input id = "username" type = "text" name = "username" placeholder="username" required></td>
            </tr>
            <tr>
                <td><label for="birthdate">BIRTHDATE: </label></td>
                <td><input type="date" name=birthdate id="birthdate" required></td>
            </tr>
            <tr>
                <td><label for="email">E-mail: </label></td>
                <td><input type="email" name=email id="email" required></td>
            </tr>
        </table>

        <?php
            echo ("<input type = 'submit' value = 'Submit'>");
        ?>
    </form>

    <a href="login.php">back</a>
    
</body>
</html>