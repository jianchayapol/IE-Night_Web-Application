<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <div><h1>Admin Login</h1></div>
    <form action="admin_login_handler.php" method=POST>
        <table>
            <tr>
                <td><label for="admin_user">Admin username: </label></td>
                <td><input type="text" id="admin_user" name="admin_user" placeholder="username" required></td>
            </tr>
            <tr>
                <td><label for="admin_pass">Admin password: </label></td>
                <td><input type="password" id="admin_pass" name="admin_pass" placeholder="password" required></td>
            </tr>
        </table>
        <input type="submit" name="Login">
    </form>
</body>
</html>