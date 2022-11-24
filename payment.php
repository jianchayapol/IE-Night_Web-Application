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
    <title>Payment</title>
</head>
<body>
    <div><h2>Payment</h2></div>
    <form action="payment_handler.php" method=POST enctype="multipart/form-data">
        <?php
            require("connection.php");
            $ttl_price = 0;

            $id_in_cart = implode(", ", array_keys($_SESSION["cart"]));

            $query_show = "SELECT * FROM tbl_merchandises WHERE id IN ($id_in_cart)";
            $result_show = mysqli_query($db, $query_show);
        
            while($list_show = mysqli_fetch_array($result_show)) {
                $mer_id = $list_show["id"];
                $ttl_price += $list_show["price"]*$_SESSION["cart"][$mer_id];
            }
        ?>

        <!--start test-->
        
        <h5>Please make the transaction via: KBANK: 333-1-55555-1 </h5>
        <div>--or scan here and complete the payment--</div><br>
        <?Php
        
        require_once("promptpay(plugin)/PromptPayQR.php");

        $PromptPayQR = new PromptPayQR(); // new object
        $PromptPayQR->size = 8; // Set QR code size to 8
        $PromptPayQR->id = '0877573332'; // PromptPay ID
        $PromptPayQR->amount = $ttl_price; // Set amount (not necessary)
        echo '<img src="' . $PromptPayQR->generate() . '" width=300/>';
        ?>
        <!--end test-->

        <h4>Shipping Address: </h4><textarea name="shipping_address" placeholder="Enter Shipping Address here.." required></textarea><br><br>
        
        <div><h4>Total Price: <?php echo("$".$ttl_price) ?></h4></div>
        
        <!-- <div></div><img src="./admin/admin_image/admin_qr.jpg" alt="QR code for payment" width=300></div><br><br> -->

        <div><label for="upload">upload receipt: </label></div> <br>
        <input type="file" id="upload" name="banking" required>
        <br><br>
        <button type="submit" name="ttl_price" value=<?php echo("$ttl_price") ?> style=" color:darkred; size: 40px;">Submit</button>
        
    </form>
    
</body>
</html>