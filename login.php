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
    <div><h2>LOG IN</h2></div>

    <form action = "login_handler.php" method = POST>
        <table>
            <tr>
                <td><label for="username">USERNAME</label></td> <td><input id = "username" type = "text" name = "cus_user" placeholder="username" required></td>
            </tr>
            <tr>
                <td><label for="password">PASSWORD</label></td> <td><input id = "password" type = "password" name = "cus_pass" placeholder="password" required></td>
            </tr>
        </table>

        <?php
            echo ("<input type = 'submit' value = 'Log in'>");
        ?>
    </form>

    <form action = "signup.php" method = POST>
        <?php
            echo ("---or---<br><br>");
            echo ("<A HREF = 'signup.php'>Sign up</A>");
        ?>
    </form>
    
</body>
</html>
