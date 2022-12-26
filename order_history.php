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


        $alt_text_filter = "";
        // order by cmd
        $query_cmd = "";
        if (isset($_GET['order_by'])){
            $order_type = $_GET['order_by'];
            $query_cmd = $query_cmd." ORDER BY timestamp ".$order_type;
            if($order_type=="ASC"){
                $alt_text_filter = $alt_text_filter."    "."<li>Sort By Order Date : Oldest to Newest ";
            }
            else{
                $alt_text_filter = $alt_text_filter."    "."<li>Sort By Order Date : Newest to Oldest ";
            }
        }

        #search by Product Name
        $search_name_cmd = "";
        if (isset($_GET['searched_id']) && $_GET['searched_id'] != "" ){
            $search_name= $_GET['searched_id'];
            $search_name_cmd= " AND merch.name LIKE '"."%".$search_name."%"."'";
            $alt_text_filter = $alt_text_filter."    "."<br><li> Search By Product : $search_name";
        }

        $query = 
               "SELECT merch.name as product_name, 
               merch.picture as product_pic,
               merch.unit as unit,
               merch.price as price,
               ordering.quantity as order_quantity,
               orders.timestamp as order_date,
               orders.id as order_id,
               orders.payment_status as order_payment_status,
               orders.shipping_status as order_shipping_status
           FROM tbl_customers cus, tbl_orders orders, tbl_ordering ordering, tbl_merchandises merch
           WHERE cus.username = '$cus_user' AND
               cus.username = orders.customer_user AND
               orders.id = ordering.order_id AND
               merch.id = ordering.merchandise_id".$search_name_cmd.$query_cmd;
        
        // echo $query;
        $result = mysqli_query($db, $query);
        $num_row = mysqli_num_rows($result);
                if($num_row>0){
                    $alt_text_result = "<br>  [ $num_row  orders found ] ".$alt_text_result;
                }
                else{
                    $alt_text_result = "<br>  [ NO MATCHED ORDER HISTORY ]".$alt_text_result;
                }
    ?>  
        <form action="order_history.php" method=GET>
            <fieldset >
            <legend><h1> Order History </h1> </legend>

            <div><p>Order By</p>
            <input type="radio" id="orderChoice1" name="order_by" value="ASC" />
            <label for="orderChoice1"><u>O</u>ldest-to-Newest</label><br>

            <input type="radio" id="orderChoice2" name="order_by" value="DESC" />
            <label for="orderChoice2"><u>N</u>ewest-to-Oldest</label><br>

            </div>
            <div>
            <p>-or-</p>
            <label for="search">Search: </label>
            <input type="text" id="search" name="searched_id" placeholder="Enter Product Name..." />
            <br><br>

            <button type="submit">Go</button>
            <button type="submit">Clear All Selections</button>
        </form>
        </div>
        <?php 
        echo "<div style='Color:blue'><p>$alt_text_filter<br></p></div>" ;
        echo "<div style='Color:blue'><h4> $alt_text_result </h4><br></div>"; ?>
        <div>
            <Table>
                <tr style="background-color:darkred; color:white">
                <td><h2>Merchandise</td>
                <td></td>
                <td><h2>Quantity</td>
                <td><h2>Total Price</h2></td>
                <td><h2>Order Date</td>
                <td><h2><center>Order Status</center></td>
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
                    $order_id = $list_show["order_id"];
                    $order_payment_status = $list_show["order_payment_status"];
                    $order_shipping_status = $list_show["order_shipping_status"];

                    $order_status = "Pending..";
                    $order_status_color = "yellow";
                    if($order_payment_status){
                        if(!$order_shipping_status){
                            $order_status = "Payment Approved";
                            $order_status_color = "#50C878";
                        }else{
                            $order_status = "In-Delivery";
                            $order_status_color = "skyblue";
                        }
                    }
                    if($mer_pic != "") {
                        $mer_pic = "<img src='./image/merchandises/$mer_pic' height='180' width='180'";
                    }
                    echo(
                        "<tr>
                            <td><h3><li>$mer_name</h3></td>
                            <td>$mer_pic</td>
                            <td><h3>$order_quantity  $mer_unit<h3></td>
                            <td><h3> $total_price  Baht</h3></td>
                            <td><h3>$order_date<br> [ID: $order_id]<h3></td>
                            <td style='background-color:$order_status_color'><h3><center>$order_status<center><h3></td>
                        </tr>"
                    );
                }
            ?>


        </Table> 
        </div>
        </fieldset>

</body>
</html>







