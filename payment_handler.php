<?php
    session_start();
    require("connection.php");
    print_r($_POST);
    //new record in table tbl_orders
    $shipping_address = $_POST["shipping_address"];
    $ttl_price = $_POST["ttl_price"];
    $customer_user = $_SESSION["cus_user"];

    $new_rec_query = "INSERT INTO tbl_orders SET shipping_address='$shipping_address', ttl_price='$ttl_price', customer_user='$customer_user'";
    mysqli_query($db, $new_rec_query);
    //print_r($_FILES);
    $id_query = "SELECT id FROM tbl_orders ORDER BY id DESC";
    $id_result = mysqli_query($db, $id_query);
    if($id_list = mysqli_fetch_array($id_result)) {
        $order_id = $id_list["id"];
        $fname = explode(".", $_FILES["banking"]["name"]);
        $new_filename = $order_id.".".$fname[1];
        move_uploaded_file($_FILES["banking"]["tmp_name"], "./image/banking/".$new_filename);
        
        $file_query = "UPDATE tbl_orders SET payment_upload = '$new_filename' WHERE id='$order_id'";
        mysqli_query($db, $file_query);

        //new record in tbl_ordering
        foreach($_SESSION["cart"] as $mer_id => $quantity) {
            $query = "INSERT INTO tbl_ordering SET order_id='$order_id', merchandise_id='$mer_id', quantity='$quantity'";
            mysqli_query($db, $query);
        }
    }
    unset($_SESSION["cart"]);
    header("refresh: 0; url=thankyou.php");
?>