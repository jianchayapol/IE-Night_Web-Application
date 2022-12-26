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
    <title>Manage Staff</title>

    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th,td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #DDD;
        }
        tr:hover {
            background-color: #EFF7FA;
        }
    </style>
    
</head>
<body>
    <h2>Staff</h2>
    <table border=1>
        <tr style="background-color:darkred; color:white">
            <td>username</td>
            <td>password</td>
            <td>name</td>
            <td>surname</td>
            <td>telphone</td>
            <td>edit</td>
        </tr>

        <?php
            require("../connection.php");

            if(isset($_POST["staff_user"])) {
                $staff_user = $_POST["staff_user"];
                $staff_pass = $_POST["staff_pass"];
                $staff_name = $_POST["staff_name"];
                $staff_surname = $_POST["staff_surname"];
                $staff_tel = $_POST["staff_tel"];
            }
            
            if(isset($_POST["action"])) {
                $check_query = "SELECT * FROM tbl_admins WHERE username = '$staff_user'";
                $check_result = mysqli_query($db, $check_query);
                //edit
                if($_POST["action"] == "submit_edit") {
                    if ($staff_user != $_POST["old_user"] AND mysqli_num_rows($check_result) != 0) {
                        echo ("This username is already exist!");
                    } else {
                        $query = "UPDATE tbl_admins SET username = '$staff_user', password = '$staff_pass', name = '$staff_name', surname = '$staff_surname', telephone = '$staff_tel' WHERE username = '$staff_user'";
                        mysqli_query($db, $query);
                    }
                }               
                //add new
                else if($_POST["action"] == "add_new" AND mysqli_num_rows($check_result) == 0) {
                    $query = "INSERT INTO tbl_admins SET username = '$staff_user', password = '$staff_pass', name = '$staff_name', surname = '$staff_surname', telephone = '$staff_tel'";
                    mysqli_query($db, $query);
                } 
                // delete
                else if($_POST["action"] == "delete") {
                    $staff_id = $_POST["old_user"];

                    $del_query = "DELETE FROM tbl_admins WHERE username = '$staff_id'";
                    mysqli_query($db, $del_query);
                } else {
                    echo ("This username is already exist!");
                }

            }
            
            // show
            $query_show = "SELECT * FROM tbl_admins";
            $result_show = mysqli_query($db, $query_show);
            while($list_show = mysqli_fetch_array($result_show)) {
                $staff_user = $list_show['username'];
                $staff_pass = $list_show['password'];
                $staff_name = $list_show['name'];
                $staff_surname = $list_show['surname'];
                $staff_tel = $list_show['telephone'];
                echo("
                    <tr>
                        <td>$staff_user</td>
                        <td>$staff_pass</td>
                        <td>$staff_name</td>
                        <td>$staff_surname</td>
                        <td>$staff_tel</td>
                        <td><a href='manage_staff.php?staff_user=$staff_user'>edit</a></td>
                    </tr>
                ");
            }
        ?>
    </table>
    <br><br>
    
    <form action="manage_staff.php" method=POST>
        <?php
            if(isset($_GET["staff_user"])) {
                echo ("Edit Staff");
                $staff_user = $_GET["staff_user"];
                $query_edit = "SELECT * FROM tbl_admins WHERE username = '$staff_user'";
                $result_edit = mysqli_query($db, $query_edit);
                if($list_edit = mysqli_fetch_array($result_edit)) {
                    $edit_user = $list_edit['username'];
                    $edit_pass = $list_edit['password'];
                    $edit_name = $list_edit['name'];
                    $edit_surname = $list_edit['surname'];
                    $edit_tel = $list_edit['telephone'];
                }
                $action = "edit";
            } else {
                echo ("<br><b>Add New Staff<b>");
                $edit_user = "";
                $edit_pass = "";
                $edit_name = "";
                $edit_surname = "";
                $edit_tel = "";
                $action = "add_new";
            }
        ?>
        <br><br>
        <table>
            <tr>
                <td><label for="username">username: </label></td>
                <td><input type="text" id="username" name="staff_user" value="<?php echo($edit_user) ?>" placeholder="username" required></td>
            </tr>
            <tr>
                <td><label for="password">password:</label></td>
                <td><input type="text" id="password" name="staff_pass" value="<?php echo($edit_pass) ?>" placeholder="password" required></td>
            </tr>
            <tr>
                <td><label for="name">name: </label></td>
                <td><input type="text" id="name" name="staff_name" value="<?php echo($edit_name) ?>" placeholder="name" required></td>
            </tr>
            <tr>
                <td><label for="surname">surname: </label></td>
                <td><input type="text" id="surname" name="staff_surname" value="<?php echo($edit_surname) ?>" placeholder="surname" required></td>
            </tr>
            <tr>
                <td><label for="tel">telephone: </label></td>
                <td><input type="tel" id="tel" name="staff_tel" value="<?php echo($edit_tel) ?>" placeholder="0XX-XXX-XXXX" pattern="0[0-9]{2}-[0-9]{3}-[0-9]{4}" required></td>
            </tr>
        </table>
        <?php
            if($action == "edit") {
                echo ("
                <button type='submit' name='action' value='submit_edit'>submit edit</button>
                <input type='hidden' name='old_user' value='$edit_user'>");
                echo ("
                <button type='submit' name='action' value='delete'>delete</button>
                <input type='hidden' name='old_user' value='$edit_user'>");
            } else {
                echo ("<br><input type='submit' value='add new'>
                <input type='hidden' name='action' value='add_new'>");
            }
        ?>
    </form>
    
</body>
</html>