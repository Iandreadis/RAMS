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
        <title>RAMS - Search Results</title>
    </head>
    <body>
        <!-- Include page header -->
        <?php include 'header.php';?>
        <p></p>
        <h1>RAMS - Search Results</h1>
        <?php
        
        
        // Create an Object of class User
        $LoggedUser = new User();
        
        // Retrieves the logged user id stored in the session cookie
        $LoggedID = $LoggedUser->GetLoggedUser();
        $isadmin = $LoggedUser->IsAdmin( $LoggedID );
        
        
        // search_product of RAMS API returns a JSON file
        $prod_info = file_get_contents(WEB_SERVER.'api.php?action=search_product&st='.$_POST['searchtext']);

        // json_decode function decodes JSON data and produces an associative array
        $array_info = json_decode($prod_info, true);
        
        
        // Each product line is a form where the buyer inserts the quantity he is intending to buy
        echo "<form name=\"inbasket\" action=\"api.php?action=in_basket\" method=\"POST\" enctype=\"multipart/form-data\">";
        
        // HTML table to display product data
        echo "<table style=\"width: 95%;\">";
        
        // Column headers
        echo "<tr>";
        
        // Display Add to basket button only if the user is customer
        if( $LoggedID > 0 && $isadmin == 0){
            echo "<td style=\"padding: 12px;\"><strong>Item code</td><td style=\"padding: 12px;\"><strong>Photo</td><td style=\"padding: 12px;\"><strong>Item name</td><td style=\"padding: 12px;\"><strong>Available</td><td style=\"padding: 12px;\"><strong>Information</td><td style=\"padding: 12px;\"><strong>Quantity</strong></td>";
            echo "<td><div style='text-align: center;'><input type=\"submit\" name=\"Submit\" value=\"Add to basket\"\></div></td>";
        }
        else {
            echo "<td style=\"padding: 12px;\"><strong>Item code</td><td style=\"padding: 12px;\"><strong>Photo</td><td style=\"padding: 12px;\"><strong>Item name</td><td style=\"padding: 12px;\"><strong>Available</td><td style=\"padding: 12px;\"><strong>Information</td>";
        }
        echo "</tr>";
        
        $i=0;
        
        if( isset($array_info))
        {
            // Iterate products array and create table rows to display item data
            foreach ($array_info as $key => $value) 
            { 
                echo "<tr>";
                $i++;

                foreach ($value as $k => $v) 
                {
                    echo "<td style=\"padding: 12px;\">";
                    // $in_basket_id gets the logged user id
                    if (strcmp ($k, "id") == 0)
                        $in_basket_id = $v;
                    // If array key is "prod_image", HTML code to display the image
                    if (strcmp ($k, "prod_image") == 0){
                        echo "<img class=\"prod_image\" src='photos/".$v."' alt=\"Not available image\" height=\"80\"/>";
                    }
                    else
                    // otherwise display the key value
                        echo $v; 
                    echo "</td>";
                }

                // Order quantity input field, only for registerd customers
                if( $LoggedID > 0 && $isadmin == 0){

                    echo "<td style=\"padding: 12px;\">";
                    echo "<input type=\"number\" name=\"prod_quan_".$i."\" value=\"0\" size=\"3\" min=\"0\" step=\"1\" style=\"width: 40px;\"\>";
                    echo "</td>";
                }

                echo "<td>";
                // The hidden field "in_basket_prod_id" passes the item_id to the "in_basket" function
                echo "<input type=\"hidden\" name=\"prod_id_".$i."\" value=\"$in_basket_id\" \>";
                echo "</tr>";
            }  
        }
        
        echo "</table>";
        
        // The hidde field "in_basket_user_id" passes the logged user id to the "in_basket" function
        echo "<input type=\"hidden\" name=\"in_basket_user_id\" value=\"$in_basket_user_id\" \>";
        
        // "Order" button
        if( $LoggedID > 0 && $isadmin == 0){
            echo "<hr><div style='text-align: center;'><input type=\"submit\" name=\"Submit\" value=\"Add to basket\"\></div>";
        }
        echo "</td>";

        echo "</form>";
        
        ?>
        
        <!-- Include page footer -->
        <?php include './footer.php';?>
    </body>
</html>
