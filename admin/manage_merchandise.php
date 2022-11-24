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
    <title>Manage Merchandises</title>

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
      <h2>Merchandises</h2>
      <table border=1>
        <tr style="background-color:darkred; color:white">
            <td>id</td>
            <td>name</td>
            <td>price</td>
            <td>unit</td>
            <td>stock</td>
            <td>description</td>
            <td>picture</td>
            <td>edit</td>
        </tr>

        <?php
            require("../connection.php");

            if(isset($_POST["action"])) {
                // add new
                if($_POST["action"] == "add_new") {
                    $mer_name = $_POST["mer_name"];
                    $mer_price = $_POST["mer_price"];
                    $mer_unit = $_POST["mer_unit"];
                    $mer_stock = $_POST["mer_stock"];
                    $mer_des = $_POST["mer_des"];

                    $add_query = "INSERT INTO tbl_merchandises SET name = '$mer_name', price = '$mer_price', unit = '$mer_unit', stock = '$mer_stock', description = '$mer_des'";
                    mysqli_query($db, $add_query);

                    if($_FILES["mer_pic"]["name"] != "") {
                        $id_query = "SELECT id FROM tbl_merchandises ORDER BY id DESC";
                        $id_result = mysqli_query($db, $id_query);
                        if($id_list = mysqli_fetch_array($id_result)) {
                            $mer_id = $id_list["id"];
                            $fname = explode(".", $_FILES["mer_pic"]["name"]);
                            $new_filename = $mer_id.".".$fname[1];
                            move_uploaded_file($_FILES["mer_pic"]["tmp_name"], "../image/merchandises/".$new_filename);
                            
                            $file_query = "UPDATE tbl_merchandises SET picture = '$new_filename' WHERE id='$mer_id'";
                            mysqli_query($db, $file_query);
                        }                        
                    }
                }

                // edit
                if($_POST["action"] == "submit_edit") {
                    $mer_id = $_POST["mer_id"];
                    $mer_name = $_POST["mer_name"];
                    $mer_price = $_POST["mer_price"];
                    $mer_unit = $_POST["mer_unit"];
                    $mer_stock = $_POST["mer_stock"];
                    $mer_des = $_POST["mer_des"];

                    $edit_query = "UPDATE tbl_merchandises SET name = '$mer_name', price = '$mer_price', unit = '$mer_unit', stock = '$mer_stock', description = '$mer_des' WHERE id = '$mer_id'";
                    mysqli_query($db, $edit_query);

                    if($_FILES["mer_pic"]["name"] != "") {
                        $fname = explode(".", $_FILES["mer_pic"]["name"]);
                        $new_filename = $mer_id.".".$fname[1];
                        move_uploaded_file($_FILES["mer_pic"]["tmp_name"], "../image/merchandises/".$new_filename);

                        $file_query = "UPDATE tbl_merchandises SET picture = '$new_filename' WHERE id='$mer_id'";
                        mysqli_query($db, $file_query);
                    }
                }

                // delete
                if($_POST["action"] == "delete") {
                    $mer_id = $_POST["mer_id"];

                    $del_query = "DELETE FROM tbl_merchandises WHERE id = '$mer_id'";
                    mysqli_query($db, $del_query);
                }
            }
            
            // show
            $query_show = "SELECT * FROM tbl_merchandises";
            $result_show = mysqli_query($db, $query_show);
            while($list_show = mysqli_fetch_array($result_show)) {
                $mer_id = $list_show["id"];
                $mer_name = $list_show["name"];
                $mer_price = $list_show["price"];
                $mer_unit = $list_show["unit"];
                $mer_stock = $list_show["stock"];
                $mer_des = $list_show["description"];
                $mer_pic = $list_show["picture"];
                if($mer_pic != "") {
                    $mer_pic = "<img src='../image/merchandises/$mer_pic' height='100' width='100'";
                }
                echo ("
                    <tr>
                        <td>$mer_id</td>
                        <td>$mer_name</td>
                        <td>$mer_price</td>
                        <td>$mer_unit</td>
                        <td>$mer_stock</td>
                        <td>$mer_des</td>
                        <td>$mer_pic</td>
                        <td><a href='manage_merchandise.php?mer_id=$mer_id'>edit</a></td>
                    </tr>
                ");
            }
        ?>

        <form action="manage_merchandise.php" method=POST enctype="multipart/form-data">
            <?php
                if(isset($_GET["mer_id"])) {
                    echo ("Edit Merchandise");
                    $mer_id = $_GET["mer_id"];
                    $query_edit = "SELECT * FROM tbl_merchandises WHERE id = '$mer_id'";
                    $result_edit = mysqli_query($db, $query_edit);
                    if($list_edit = mysqli_fetch_array($result_edit)) {
                        $edit_id = $list_edit["id"];
                        $edit_name = $list_edit["name"];
                        $edit_price = $list_edit["price"];
                        $edit_unit = $list_edit["unit"];
                        $edit_stock = $list_edit["stock"];
                        $edit_des = $list_edit["description"];
                        $edit_pic = $list_edit["picture"];
                    }
                    $action = "edit";
                } else {
                    echo ("<br><b>Add New Merchandise</b>");
                    $edit_name = "";
                    $edit_price = "";
                    $edit_unit = "";
                    $edit_stock = "";
                    $edit_des = "";
                    $edit_pic = "";
                    $action = "add_new";
                }
            ?>
            </br>
            <table>
                <br><br>
                <tr>
                    <td><label for="name">name:</label></td>
                    <td><input type="text" id="name" name="mer_name" value="<?php echo($edit_name) ?>" placeholder="name" required></td>
                </tr>
                <tr>
                    <td><label for="price">price: </label></td>
                    <td><input type="text" id="price" name="mer_price" value="<?php echo($edit_price) ?>" placeholder="price($)" required></td>
                </tr>
                <tr>
                    <td><label for="unit">unit: </label></td>
                    <td><input type="text" id="unit" name="mer_unit" value="<?php echo($edit_unit) ?>" placeholder="unit" required></td>
                </tr>
                <tr>
                    <td><label for="stock">stock: </label></td>
                    <td><input type="number" id="stock" name="mer_stock" value="<?php echo($edit_stock) ?>" min="0" placeholder="remaining stock" requierd></td>
                </tr>
                <tr>
                    <td><label for="des">description: </label></td>
                    <td><textarea id="des" name="mer_des" placeholder="description..."><?php echo($edit_des) ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="pic">add picture: </label></td>
                    <td><input type="file" id="pic" name="mer_pic"></td>
                </tr>
            </table>
            <?php
                if($action == "edit") {
                    echo ("
                    <button type='submit' name='action' value='submit_edit'>submit edit</button>
                    <input type='hidden' name='mer_id' value='$mer_id'>");
                    echo ("
                    <button type='submit' name='action' value='delete'>delete</button>
                    <input type='hidden' name='mer_id' value='$mer_id'>");
                    // echo ("<input type='submit' name='action' value='submit edit'>
                    // <input type='hidden' name='mer_id' value='$mer_id'>");
                    // echo ("<input type='submit' name='action' value='delete'>
                    // <input type='hidden' name='mer_id' value='$mer_id'>");
                } else {
                    echo ("<br><br><input type='submit' value='add new'>
                    <input type='hidden' name='action' value='add_new'>");
                }
            ?>
        </form>
      </table>
</body>
</html>