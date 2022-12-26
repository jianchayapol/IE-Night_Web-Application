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
    <title>Manage Orders</title>

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
    <h1>Orders Status</h1>

    <form action="manage_order.php" method=GET>
    <fieldset>
        <legend>Menu</legend>
        <div><p>Filter By</p>
        <input type="radio" id="filterChoice1" name="filter_by" value="" />
        <label for="filterChoice1">View All</label><br>

        <input type="radio" id="filterChoice2" name="filter_by" value=" WHERE payment_status=1" />
        <label for="filterChoice2">View Only <u>Ap</u>proved Payment</label><br>

        <input type="radio" id="filterChoice3" name="filter_by" value=" WHERE payment_status=0" />
        <label for="filterChoice3">View Only <u>Un</u>approved Payment</label>
        </div>
        <div>
        <p>-or-</p>
        <label for="search">Search: </label>
        <input type="text" id="search" name="searched_id" placeholder="Enter Order ID..." />
        <br><br><button type="submit">Go</button>
        </div>
    </fieldset>
    </form>

    <?php

        #filter by cmd
        $filter_type="";
        $query_cmd = "";
        $filter_alt = "";
        if (isset($_GET['filter_by'])){
            $filter_type = $_GET['filter_by'];
            $query_cmd = $query_cmd.$filter_type;
        }

        #search by ID
        $search_id="";
        $search_id_cmd = "";
        if (isset($_GET['searched_id']) && $_GET['searched_id'] != "" ){
            $search_id= $_GET['searched_id'];
            if (isset($_GET['filter_by'])){
                $search_id_cmd= $search_id_cmd.' AND (id LIKE "%'.$search_id.'%")';
            }else{
                $search_id_cmd= $search_id_cmd.' WHERE id LIKE "%'.$search_id.'%"';
            }
        }

        if($search_id!="") { echo ('search: '.$search_id); }
        if($filter_type==" WHERE payment_status=1") { echo "* Only Approved Orders";}
        if($filter_type==" WHERE payment_status=0") { echo "* Only Unapproved Orders";}

        require("../connection.php");
        $query = ("SELECT * FROM tbl_orders".$query_cmd.$search_id_cmd);
        $result = mysqli_query($db, $query);
        $num_row = mysqli_num_rows($result);
        ?>

    <form action="admin_update_order_handler.php" method=POST>

        <?php
        echo "<table style='width : 100%' >";
        if($num_row>0){
            echo "<p>[ $num_row results found] </p>";
        }else{
            echo "<p> [ <u>No</u> matched result found] </p>";
        }
        echo ("<tr style='background-color:darkred; color:white'>
                    <td>id</td>
                    <td>customer</td>
                    <td>timestamp</td>
                    <td>payment upload</td>
                    <td>total price (baht)</td>
                    <td>payment status</td>
                    <td>order details</td>
                    <td>shipping status</td>
                    <td>shipping address</td>
                </tr>
            ");

        while ($list = mysqli_fetch_array($result)) {
            $id = $list["id"];
            $customer = $list["customer_user"];
            $timestamp = $list["timestamp"];
            $payment_filename = $list["payment_upload"];
            $payment_upload = "<img src='../image/banking/$payment_filename' width='120' alt='no payment uploaded'";
            $total_price = $list["ttl_price"];
            $payment_status = $list["payment_status"];
            $address = $list["address"];
            $road = $list["road"];
            $district = $list["district"];
            $county = $list["county"];
            $province = $list["province"];
            $zipCode = $list["zip_code"];
            $shipping_status = $list["shipping_status"];

            $payment_check_color = 'white';
            if ($payment_status == 1) {
                $payment_check = '<input type="checkbox" name="payment_added_id[]" value=' . $id . ' checked><br> ';
                $payment_check_color = 'lightgreen';
            } else {
                $payment_check = '<input type="checkbox" name="payment_added_id[]" value=' . $id . ' unchecked><br> ';
            }

            $shipping_check_color = 'white';
            if ($shipping_status == 1) {
                $shipping_check = '<input type="checkbox" name="shipping_added_id[]" value=' . $id . ' checked><br> ';
                $shipping_check_color = 'lightgreen';
            } else {
                $shipping_check = '<input type="checkbox" name="shipping_added_id[]" value=' . $id . ' unchecked><br>';
            }

            #query merchandise lists of this order
            $query2 = "SELECT merch.name as merchandise_name, merch.id as merchandise_id,ord.quantity as quantity 
                        FROM tbl_ordering ord, tbl_merchandises merch 
                        WHERE ord.order_id = $id AND ord.merchandise_id = merch.id";
            $merch_tmp_list = mysqli_query($db, $query2);

            $order_merch = '';
            
            while ($tmp_list = mysqli_fetch_array($merch_tmp_list)) {
                $merch_i = $tmp_list['merchandise_name'];
                $merch_id_i = $tmp_list['merchandise_id'];
                $quan_i = $tmp_list['quantity'];
                $order_merch = $order_merch.$quan_i.' x  '.$merch_i.' [ID:'.$merch_id_i.']   <br>';
            }

            echo ("<tr>
                    <td>$id</td>
                    <td>$customer</td>
                    <td>$timestamp</td>
                    <td>$payment_upload</td>
                    <td><b>$total_price<b></td>
                    <td style='background-color:$payment_check_color'>$payment_check</td>
                    <td>$order_merch</td>
                    <td style='background-color:$shipping_check_color'>$shipping_check</td>
                    <td>$address $road $district $county $province $zipCode</td>
                    <td><a href='delete_order_handler?order_id=$id'>Delete</a></td>
                </tr>
                <br>
            ");
        }   
        ?>
        </table>

        <br><br><input type='submit' value='Save Changes'>

    </form>

</body>

</html>