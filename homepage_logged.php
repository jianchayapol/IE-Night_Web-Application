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
    <title>Homepage</title>
</head>

<style>
        .ranktable {
            border-collapse: collapse;
            width: 500;
        }
        tr,td {
            background-color: whitesmoke;
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #DDD;
        }
        .hover-table:hover {
            background-color: maroon;
            color: white
        }
    </style>

<body>
    <div>
        <h2>IE NIGHT 2022 Ticket</h2>
    </div>
    <div>
        <table class="blanktable">
            <tr>
                <td><img src="./image/merchandises/001" alt="ie night 2022 ticket" height = 100></td>
                <td>
                    <p><h3>Ticket Pass for IE night event<br> held on 4.2.2023</h3></p>
                    <a href = "ie_night_detail.php" style="color: blue; size: 45px;">LEARN MORE</a>
                </td>
            </tr>
        </table>
    </div>
    <!-- <div background-color: gray></div> -->
    <fieldset >
            <legend><h2> MERCHANDISES </h2> </legend>

    <?php
        $query = 
        "SELECT merch.name as product_name, 
        merch.picture as product_pic,
        merch.price as price,
        SUM(ordering.quantity) as total_sold 
    FROM tbl_ordering ordering, tbl_merchandises merch
    WHERE ordering.merchandise_id = merch.id
    GROUP BY ordering.merchandise_id
    ORDER BY SUM(ordering.quantity) DESC
    LIMIT 3 ;";
    
    $result = mysqli_query($db, $query);
    
    ?>

    <div class ="ranktable">
        <table>
        <?php
        $ranking = 1;
        echo("<h3 style='color: maroon' ><I>* BEST SELLER *</h3>");
        while($list_show = mysqli_fetch_array($result)) 
                {
                    $mer_name = $list_show["product_name"]; 
                    $mer_pic = $list_show["product_pic"];
                    $mer_price = $list_show["price"];
                    $total_sold = $list_show["total_sold"];

                    if($mer_pic != "") {
                        $mer_pic = "<img src='./image/merchandises/$mer_pic' height='100' width='100'";
                    }
                    echo(
                        "<td class='hover-table'><center>
                            <h2>  #$ranking   $mer_name</h2>
                            $mer_pic<br>
                            <h3> $mer_price  Baht</h3>
                            </center>
                        </td>"
                    );
                    $ranking+=1;
                }
        
            ?>
        </table>
    </div>
    <br>
    <div><a href="shopping.php"  style="color: blue; size: 50px;">NEXT TO SHOPPING</a></div>
    <br><br>


		</table>
	</div>

    
</body>
</html>
