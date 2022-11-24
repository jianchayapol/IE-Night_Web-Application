<?php
session_start();
require("connection.php");
require("check_login.php");
require("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>

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
            color: darkred;
            background-color: #FAFAFA;
        }
    </style>

</head>
<body>
    <?php
        $alt_text_result = "";

        if(!isset($_SESSION["cus_user"])){
            header("refresh: 0; url = login.php");
        }else{
            $cus_user =$_SESSION["cus_user"];
        }
        $query = 
               "SELECT merch.name as product_name, 
               merch.picture as product_pic,
               merch.unit as unit,
               merch.price as price,
               sum(ordering.quantity) as order_quantity,
               orders.timestamp as order_date
           FROM tbl_customers cus, tbl_orders orders, tbl_ordering ordering, tbl_merchandises merch
           WHERE cus.username = '$cus_user' AND
               cus.username = orders.customer_user AND
               orders.id = ordering.order_id AND
               merch.id = ordering.merchandise_id
            Group By merch.name";
            
        $result = mysqli_query($db, $query);
        $num_row = mysqli_num_rows($result);
                if($num_row>0){
                    $alt_text_result = "<br>  [ $num_row  orders found ] ".$alt_text_result;
                }
                else{
                    $alt_text_result = "<br>  [ NO ORDER HISTORY FOUND ]".$alt_text_result;
                }
        
    ?>
        <fieldset >
        <legend><h1> Order History </h1> </legend>
        <?php echo "<h4> $alt_text_result </h4><br>"; ?>
        <div>
            <Table>
                <tr style="background-color:darkred; color:white">
                <td><h2>Merchandise</td>
                <td></td>
                <td><h2>Quantity</td>
                <td><h2>Total Price</h2></td>
                <td><h2>Order Date</td>
                </tr>
            <?php
                while($list_show = mysqli_fetch_array($result)) 
                {
                    $mer_name = $list_show["product_name"]; 
                    $mer_pic = $list_show["product_pic"];
                    $order_quantity = $list_show["order_quantity"];
                    $mer_price = $list_show["price"];
                    $total_price = intval($order_quantity)*intval($mer_price);
                    $mer_unit = $list_show["unit"];
                    $order_date = $list_show["order_date"];
                    if($mer_pic != "") {
                        $mer_pic = "<img src='./image/merchandises/$mer_pic' height='180' width='180'";
                    }
                    echo(
                        "<tr>
                            <td><h3><li>$mer_name</h3></td>
                            <td>$mer_pic</td>
                            <td><h3>$order_quantity  $mer_unit<h3></td>
                            <td><h3> $total_price  Baht</h3></td>
                            <td><h3>$order_date<h3></td>
                        </tr>"
                    );
                }
            ?>


        </Table> 
        </div>
        </fieldset>

</body>
</html>







