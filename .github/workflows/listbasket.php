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
        <title>RAMS - Your shopping basket</title>
    </head>
    <body>
        <!-- Include page header -->
        <?php include 'header.php';?>
        <p style="text-align:right"><a href="shop.php">Continue shopping</a></p>
        <p></p>
        <h1>Your shopping basket</h1>
        
        <form method="POST" action="api.php?action=buy">
        
        <?php
        // Create an Object of class User
        $LoggedUser = new User();
        
        // Retrieves the logged user id stored in the session cookie
        $LoggedID = $LoggedUser->GetLoggedUser();
        
        // get_basket function of RAMS API returns a JSON file
        $prod_info = file_get_contents(WEB_SERVER.'api.php?action=get_basket&uid='.$LoggedID);
        
        // json_decode function decodes JSON data and produces an associative array
        $array_info = json_decode($prod_info, true);
        
        
        // Hidden field to store user id
        echo '<input type="hidden" name="id" value="'.$LoggedID.'"/>';
        
        // Iterate products array and create table rows to display item data
        if (isset($array_info))
        {
            // HTML table to display product data
            echo "<table style=\"width: 80%;\">";
            echo "<tr>";
            // Column headers
            echo "<td style=\"padding: 12px;\"><strong>Item</td><td style=\"padding: 12px; text-align: right;\"><strong>Quantity</td>";
            echo "</tr>";
            
            foreach ($array_info as $key => $value) 
            { 
                echo "<tr>";
                $col = 0;
                
                foreach ($value as $k => $v) 
                {
                    $col++;
                    // All columns after the first one are right aligned
                    // (because the contain numeric data
                    if ($col > 1)
                        echo "<td style=\"padding: 12px; text-align: right;\">";
                    else
                        echo "<td style=\"padding: 12px;\">";

                    echo $v; 

                    echo "</td>";
                }
                echo "</tr>";
            }
            ?>
        <tr><td>
                <input type="submit" value="Send Request"/>
        </td></tr>
        
        <?php
            echo "</table>";
        }
        else {
            // If message exists, then display it
            if( isset($_GET['msg'])  && $_GET['msg'] === '1'){
                echo "<h3>You request has been sent. You'll be noticed via email</h3>";
            }
            else{
                echo "<h4 style='color:black'>No items yet</h4>";
            }
        }
        ?>
            
        </form>
    </body>
</html>
