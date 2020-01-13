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
        <title>RAMS - Conferences</title>
    </head>
    <body>
        <!-- Include page header -->
        <?php include 'header.php';?>
        <p></p>
        <h1>More about scheduled conference</h1>
        <?php
        
        // get_conf_erences_items of RAMS API returns a JSON file
        $event_items = file_get_contents(WEB_SERVER.'api.php?action=get_conf_items&event_id='.$_GET['event_id']);
        
        // json_decode function decodes JSON data and produces an associative array
        $event_items = json_decode($event_items, true);
        
        
        // get_conf_emps of RAMS API returns a JSON file
        $event_employees = file_get_contents(WEB_SERVER.'api.php?action=get_conf_emps&event_id='.$_GET['event_id']);
        
        // json_decode function decodes JSON data and produces an associative array
        $event_employees = json_decode($event_employees, true);
        
        
        // HTML table to display product data
        echo "<h3>Allocated Products:</h3><table style='width: 100%;'>";
        // Column headers
        echo "<tr>";
        echo "<td style='padding: 0px;'><strong>Item code</td><td style='padding: 12px;'><strong>Item name</td><td style='padding: 12px;'><strong>Allocated Quantity</td>";
        echo "</tr>";
        
        // Iterate products array and create table rows to display item data
        if($event_items)
        {    
            foreach ($event_items as $key => $value) 
            { 
                echo "<tr>";
                echo "<td>".$value['id']."</td>";
                echo "<td>".$value['prod_name']."</td>";
                echo "<td>".$value['prod_stock']."</td>";
                echo "</tr>";
            }       
        }
        echo "</table>";        
        ?>
        
        <hr><br>
        <h3>Allocated Employees:</h3>
        
        <!--HTML table to display employee data-->
        <table style='width: 100%;'>

        <!--Column headers-->
        <tr>
            <td style='padding: 0px;'><strong>Lastname</td><td style='padding: 0px;'><strong>Firtsname</td><td style='padding: 0px;'><strong>Specialty</td><td style='padding: 0px;'><strong>SSN</td><td style='padding: 0px;'><strong>Tax Number</td><td style='padding: 0px;'><strong>Phone</td><td style='padding: 0px;'><strong>Email</td><td style='padding: 0px;'><strong>Address</strong></td><td></td>
        </tr>

        <?php
            // Iterate employees array and create table rows to display item data
        if($event_employees)
        {
            foreach ($event_employees as $key => $value) 
            { 
                echo "<tr>";
                echo "<td>".$value['em_lastname']."</td>";
                echo "<td>".$value['em_firstname']."</td>";
                echo "<td>".$value['specialty']."</td>";
                echo "<td>".$value['socialsecuritynumber']."</td>";
                echo "<td>".$value['tax_number']."</td>";
                echo "<td>".$value['phone']."</td>";
                echo "<td>".$value['e_mail']."</td>";
                echo "<td>".$value['address']."</td>";
                echo "</tr>";
            }   
        }
        ?>
        </table>
        
        <!-- Include page footer -->
        <?php include './footer.php';?>
    </body>
</html>

