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
        <title>RAMS - Suppliers List</title>
    </head>
    <body>
        <!-- Include page header -->
        <?php include 'header.php';?>
        <p></p>
        <h1>Suppliers List</h1>
        <?php
        
        // get_supplies of RAMS API returns a JSON file
        $suppliers_info = file_get_contents(WEB_SERVER.'api.php?action=get_suppliers');
        
        // json_decode function decodes JSON data and produces an associative array
        $suppliers = json_decode($suppliers_info, true);
        
 
        // HTML table to display product data
        echo "<table style=\"width: 100%;\">";
        
        // Column headers
        echo "<tr style='height:50px'>";
        echo "<td style=\"padding: 0px;\"><strong>First Name</td><td style=\"padding: 0px;\"><strong>Last Name</td><td style=\"padding: 0px;\"><strong>Company</td><td style=\"padding: 0px;\"><strong>Tax Number</td><td style=\"padding: 0px;\"><strong>Address</td><td style=\"padding: 0px;\"><strong>Phone</strong></td><td><strong>E-mail</strong></td><td style='width:150px'><strong>Web site</strong></td>";
        echo "</tr>";
        

        // Iterate supplies array and create table rows to display supplier data
        foreach ($suppliers as $key => $value)
        { 
            echo "<tr style='height:25px'>";
            echo "<td>".$value['firstname']."</td><td>".$value['lastname']."</td><td>".$value['company_name']."</td><td>".$value['tax_number']."</td><td>".$value['address']."</td><td>".$value['phone']."</td><td>".$value['e_mail']."</td><td><a href='http://".$value['website']."'>".$value['website']."</a></td>";
            echo "</tr>";
        }   
        
        echo "</table>";
        
        ?>
        
        <!-- Include page footer -->
        <?php include './footer.php';?>
    </body>
</html>
