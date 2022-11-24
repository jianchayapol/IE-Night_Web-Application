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
    <title>Cart</title>
</head>
<body>
        <div><h2>Cart</h2></div>
        <form action="shopping_handler.php" method=POST>
            <Table>
                <tr>
                    <th>Product</th>
                    <th>Picture</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>

                <?php
                    require("connection.php");

                    $ttl_price = 0;

                    $id_in_cart = implode(", ", array_keys($_SESSION["cart"]));

                    $query_show = "SELECT * FROM tbl_merchandises WHERE id IN ($id_in_cart)";
                    $result_show = mysqli_query($db, $query_show);
                
                    while($list_show = mysqli_fetch_array($result_show)) {
                        $mer_id = $list_show["id"];
                        $mer_name = $list_show["name"];
                        $mer_ttl_price = $list_show["price"]*$_SESSION["cart"][$mer_id];
                        $ttl_price += $mer_ttl_price;
                        $mer_pic = $list_show["picture"];
                        if($mer_pic != "") {
                            $mer_pic = "<img src='./image/merchandises/$mer_pic' height='50' width='50'";
                        }
                        
                        echo ("
                            <tr>
                                <td>$mer_name</td>
                                <td>$mer_pic</td>
                                <td><input type='number' name='id_quantity[$mer_id]' value=".$_SESSION["cart"][$mer_id]." min='0' required></td>
                                <td>$mer_ttl_price</td>                        
                            </tr>
                        ");
                    }
                    echo ("
                        <tr>
                            <td></td>
                            <td></td>
                            <td style='text-align:bottom'><h4>Total Price: </h4></td>
                            <td>$$ttl_price</td>
                        </tr>
                        <tr>
                            <td><button type='submit'>Update Changes</button><br><br></td>
                        </tr>
                    ");
                ?>
            </Table>
            <button type="submit" formaction="shopping.php">Back to shopping</button>
            <button type="submit" name="payment">Payment</button>
        </form>

</body>
</html>