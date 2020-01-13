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
        <h1>Scheduled conferences</h1>
        <?php
        // get_conferences of RAMS API returns a JSON file
        $event_info = file_get_contents(WEB_SERVER.'api.php?action=get_conferences');
        
        // json_decode function decodes JSON data and produces an associative array
        $event_info = json_decode($event_info, true);
        
        // HTML table to display product data
        echo "<table style=\"width: 100%;\">";
        // Column headers
        echo "<tr>";
        echo "<td style=\"padding: 0px;\"><strong>Starts on</td>
                <td style=\"padding: 12px;\"><strong>Ends on</td>
                <td style=\"padding: 12px;\"><strong>Conference</td>
                <td style=\"padding: 12px;\"><strong>Location</td>
                <td style=\"padding: 12px;\"><strong>Customer</td>
                <td style=\"padding: 12px;\"><strong>Event Manager</td>
                <td style=\"padding: 12px;\"><strong></td>";
        echo "</tr>";
        // Iterate conferences array and create table rows to display conference data
        foreach ($event_info as $key => $value) 
        { 
            echo "<tr style='height:25px'>";
            echo "<td>".$value['start']."</td><td>".$value['end']."</td><td>".$value['name']."</td><td>".$value['location']."</td><td>".$value['firstname']." ".$value['lastname']."</td><td>".$value['event_manager']."</td><td><a href='event_more.php?event_id=".$value['event_id']."'>more...</a></td>";
            echo "</tr>";
        }   
        echo "</table>";
        ?>
        
        <!-- Include page footer -->
        <?php include './footer.php';?>
    </body>
</html>
