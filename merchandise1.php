<?php
session_start();
require("connection.php");
echo("<a href = 'homepage_logged.php'><img src = '../image/icons/ie-night-head.png' height=200></a><br>");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
</head>
<body>
    <h1> Merchandise Details <br></h1>
    <?php

    $mer_id = "";
    if(isset($_GET['mer_id'])){
        $mer_id = $_GET['mer_id'];
    }else{
        header("refresh:0; url=shopping.php");
    }

    $query_show = "SELECT * FROM tbl_merchandises WHERE id=$mer_id";
    $result_show = mysqli_query($db, $query_show);
                
    while($list_show = mysqli_fetch_array($result_show)) 
        {
            $mer_id = $list_show["id"];
            $mer_name = $list_show["name"]; //"name" is a column in tbl_merchandises from database 
            $mer_pic = $list_show["picture"];
            $mer_price = $list_show["price"];
            $mer_desc = $list_show["description"];
            $mer_stock = $list_show["stock"];
            if($mer_stock==0){
                $mer_stock = "out-of-stock";
            }
            if($mer_pic != "") {
                $mer_pic = "<img src='../image/merchandises/$mer_pic' height='150' width='150'";
            }
        }

    // $query_purchased = "SELECT * FROM tbl_ordering WHERE merchandise_id=$mer_id";
    // $result_purchased = mysqli_query($db, $query_purchased);
    // $mer_purchased = 0;
    // while($list_purchased = mysqli_fetch_array($result_purchased)) 
    // {
    //     $mer_purchased += $list_purchased["quantity"];
    // }

    // //echo ("$mer_purchased");
    // $mer_left = $mer_stock - $mer_purchased;

        echo("
        <form action='../shopping.php' method=GET>
            <fieldset >
            <legend> product id : $mer_id </legend>
            <div>
                <Table>
                <tr>
                <td></td>
                </tr>
                <tr>
                    <td><h2> $mer_name</h2></td>
                </tr>
                <tr><td>Price: <b> $mer_price  Baht </b></td></tr>
                <tr>$mer_pic </tr>
                <tr>
                <td> (in-stock: $mer_stock) </td>
                </tr>
                <tr>
                <td>Product detail : <br> <li> $mer_desc </li></td>
                </tr>

            </Table> 
            </div>
            </fieldset>
        </form>
        ");
     ?> 
     
<div><a href="../shopping.php">Back To Shopping Page</a></div>
</body>
</html>