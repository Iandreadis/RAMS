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
        <title>RAMS - Products</title>
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
        echo "<td style='padding: 0px;'><strong>Item code</td><td style='padding: 12px;'><strong>Photo</td><td style='padding: 12px;'><strong>Item name</td><td style='padding: 12px;'><strong>Available</td><td style='padding: 12px;'><strong>Information</td>";
        echo "</tr>";
        
        $i=0;
        // Iterate products array and create table rows to display item data
        foreach ($array_info as $key => $value) 
        { 
            // Display product only if stock is over 0
            if($value['prod_stock'] > 0)
            {
                
                echo "<tr>";
                echo "<td>".$value['id']."</td>";
                echo "<td><img class='prod_image' src='photos/".$value['prod_image']."' alt='Product Image' height='80'/></td>";
                echo "<td>".$value['prod_name']."</td>";
                echo "<td>".$value['prod_stock']."</td>";
                echo "<td>".$value['prod_info']."</td>";
                echo "</tr>";
            }
        }           
        echo "</table>";
        echo "</form>";
        
        ?>
        
        <!-- Include page footer -->
        <?php include './footer.php';?>
        
    </body>
</html>
