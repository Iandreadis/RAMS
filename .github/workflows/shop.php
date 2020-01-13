<?php
    // Include the database connaection and configuration data
    include "includes/config.php";
    // Object library
    include "includes/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link href="styles/styles.css" rel="stylesheet" type="text/css" />
        <title>RAMS - Our product range</title>
    </head>
    <body>
        <!-- Include page header -->
        <?php include 'header.php';?>
        <p></p>
        <h1>Our product range</h1>
        <?php
        // get_products of RAMS API returns a JSON file
        $prod_info = file_get_contents(WEB_SERVER.'api.php?action=get_products');
        // json_decode function decodes JSON data and produces an associative array
        $array_info = json_decode($prod_info, true);
        
        
        // Each product line is a form where the buyer inserts the quantity he is intending to buy
        echo "<form name='inbasket' action='api.php?action=in_basket' method='POST' enctype='multipart/form-data'>";
        
        // HTML table to display product data
        echo "<table style='width: 95%;'>";
        // Column headers
        echo "<tr>";
        echo "<td style='padding: 12px;'><strong>Item code</td><td style='padding: 12px;'><strong>Photo</td><td style='padding: 12px;'><strong>Item name</td><td style='padding: 12px;'><strong>Available</td><td style='padding: 12px;'><strong>Information</td><td style='padding: 12px;'><strong>Quantity</strong></td><td><div style='text-align: center;'><input type='submit' name='Submit' value='Add to basket'\></div></td>";
        echo "</tr>";
        
        $i=0;
        // Iterate products array and create table rows to display item data
        foreach ($array_info as $key => $value) 
        { 
            // Display product only if stock is over 0
            if($value['prod_stock'] > 0)
            {
                
                echo "<tr>";
                $i++;

                $in_basket_id = $value['id'];
                echo "<td>".$value['id']."</td>";
                echo "<td><img class='prod_image' src='photos/".$value['prod_image']."' alt='Product Image' height='80'/></td>";
                echo "<td>".$value['prod_name']."</td>";
                echo "<td>".$value['prod_stock']."</td>";
                echo "<td>".$value['prod_info']."</td>";

                // Order quantity input field
                echo "<td style='padding: 12px;'>";
                echo "<input type='number' name='prod_quan_".$i."' value='0' size='3' min='0' max='".$value['prod_stock']."' step='1' style='width: 40px;'\>";
                
                // The hidden field "in_basket_prod_id" passes the item_id to the "in_basket" function
                echo "<input type='hidden' name='prod_id_".$i."' value='$in_basket_id' \>";
                echo "</td>";
                echo "</tr>";
            }
        }   
        
        echo "</table>";
        
        // The hidde field "in_basket_user_id" passes the logged user id to the "in_basket" function
        echo "<input type='hidden' name='in_basket_user_id' value='$in_basket_user_id' \>";
        
        // "Order" button
        echo "<hr><div style='text-align: center;'><input type='submit' name='Submit' value='Add to basket'\></div>";
        

        echo "</form>";
        
        ?>
        
        <!-- Include page footer -->
        <?php include './footer.php';?>
        
    </body>
</html>
