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
    <title>Shopping</title>

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
            background-color: #FFEDED;
        }
    </style>

</head>
<body>
    <div><h2>Merchandises</h2></div>

    <!--start-->
    <form action="shopping.php" method=GET>
    <fieldset>
        <legend>Menu</legend>
        <div><p>order By</p>
        <input type="radio" id="orderChoice1" name="order_by" value="ASC" />
        <label for="orderChoice1">$ to $$$</label><br>

        <input type="radio" id="orderChoice2" name="order_by" value="DESC" />
        <label for="orderChoice2">$$$ to $</label><br>

        </div>
        <div>
        <p>-or-</p>
        <label for="search">Search: </label>
        <input type="text" id="search" name="searched_id" placeholder="Enter Product Name..." />
        <br><br>
        <button type="submit">Go</button>
        <button type="submit">Clear All Selections</button>
        </div>
    </fieldset>
    </form>

    <?php

        $alt_text_filter = "";
        // order by cmd
        $query_cmd = "";
        if (isset($_GET['order_by'])){
            $order_type = $_GET['order_by'];
            $query_cmd = $query_cmd." ORDER BY price ".$order_type;
            if($order_type=="ASC"){
                $alt_text_filter = $alt_text_filter."    "."<li>Sort By Price : $ to $$$ ";
            }
            else{
                $alt_text_filter = $alt_text_filter."    "."<li>Sort By Price : $$$ to $ ";
            }
        }

        #search by ID
        $search_name_cmd = "";
        if (isset($_GET['searched_id']) && $_GET['searched_id'] != "" ){
            $search_name= $_GET['searched_id'];
            $search_name_cmd= $search_name_cmd." WHERE name LIKE '"."%".$search_name."%"."'";
            $alt_text_filter = $alt_text_filter."    "."<br><li> Search By Product : $search_name";
        }
    ?>
    <!--end-->

    <form action="shopping_handler.php" method=POST>
        
        <table width = "600" >
            <tr style="text-align:right; background-color:darkred; color:white">
                <td><b>Name</b></td>
                <td> </td>
                <td><b>Picture</b></td>
                <td><b>Price(Baht)</b></td>  
                <td><b>In-Stock</b></td>  
                <td><b>Quantity</b></td>    <!-- ใส่ + - จำนวนในนี้ -->
            </tr>

            <?php
                require ("connection.php");

                $query_show = ("SELECT * FROM tbl_merchandises".$search_name_cmd.$query_cmd);
                $result_show = mysqli_query($db, $query_show);
                $num_row = mysqli_num_rows($result_show);
                if($num_row>0){
                    $alt_text_filter = "<br>   [".$num_row." results found] ".$alt_text_filter;
                }
                else{
                    $alt_text_filter = "<br>   [ no matched result ] ".$alt_text_filter;
                }
                
                #to display n result(s) found
                echo "<div style='Color:Green'><p>$alt_text_filter<br></p></div>" ;
                while($list_show = mysqli_fetch_array($result_show)) 
                {
                    $mer_id = $list_show["id"];
                    $mer_name = $list_show["name"]; //"name" is a column in tbl_merchandises from database 
                    $mer_pic = $list_show["picture"];
                    $mer_price = $list_show["price"];
                    $mer_stock = $list_show["stock"];
                    $mer_url ="merchandise1.php/?mer_id=".$mer_id;
                    
                    if($mer_pic != "") {
                        $mer_pic = "<img src='./image/merchandises/$mer_pic' height='50' width='50'";
                    }

                    if(isset($_SESSION["cart"][$mer_id])) {
                        if(array_key_exists($mer_id, $_SESSION["cart"])) {
                            $quantity = $_SESSION["cart"][$mer_id];
                            echo ("
                                <tr>
                                    <td>$mer_name</td>
                                    <td><a href=$mer_url>info</a></td>
                                    <td>$mer_pic</td>
                                    <td>$mer_price</td>
                                    <td>$mer_stock</td>
                                    <td><input type='number' name='id_quantity[$mer_id]' min=0 value='$quantity' style='width: 4em' required></td>
                                </tr>
                            ");
                        }
                    } else {
                        echo ("
                            <tr>
                                <td>$mer_name</td>
                                <td><a href=$mer_url>info</a></td>
                                <td>$mer_pic</td>
                                <td>$mer_price</td>
                                <td>$mer_stock</td>
                                <td><input type='number' name='id_quantity[$mer_id]' min=0 value=0 style='width: 4em' required></td>
                            </tr>
                        ");
                    }

                    
                }
            ?>
        </table>
        <br><input type="submit" value="Check out">
        <br><br><a href = "homepage.php" style="color:blue;"> Back </a>
    </form>
    
</body>
</html>