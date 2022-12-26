<?php
require('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>
<body>
    
    <?php
        if(!isset($_GET["order_id"]) ){
            header("refresh: 0; url = manage_order.php");
        }

        $order_id = $_GET["order_id"];
        
        $query1 = "DELETE FROM tbl_ordering 
                 WHERE order_id = '$order_id' ";
        mysqli_query($db, $query1);

        $query2 = "DELETE FROM tbl_orders 
                 WHERE id = '$order_id' ";
        mysqli_query($db, $query2);
        
        
        echo '<script type="Text/JavaScript"> 
            alert("This Order has been Deleted!");
            </script>';

        header("refresh: 0; url = manage_order.php");
    ?>

</body>