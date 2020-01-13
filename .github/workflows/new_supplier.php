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
        <title>RAMS - New Supplier</title>
    </head>
    <body>
        <!-- Include page header -->
        <?php include 'header.php'; ?>
        <p></p>
        <h1>New Supplier</h1>
        
        <!-- Display message if exists -->
        <?php
        if(isset( $_GET["msg"] ) ){
            
            // If one, then all fine
            if($_GET["msg"] === "1")
                echo '<p style="color:green">Successful insertion.</p>';
            else
                echo '<p style="color:red">Insertion failed. Company already exists</p>';
        }
        ?>
        
        <form name="edit" action="api.php?action=set_new_supplier" method="POST">
            <table>
                
                <!-- First Name -->
                <tr>
                    <td>First Name:</td>
                    <td>
                        <input type="text" required name="firstname" value="" size="20"/>
                    </td>
                </tr>
                <!-- Last Name -->
                <tr>
                    <td>Last Name: </td>
                    <td>
                        <input type="text" required name="lastname" value="" size="20"/>
                    </td>
                </tr>
                
                <!-- Phone  -->
                <tr>
                    <td>Phone: </td>
                    <td>
                        <input type="tel" required name="phone" size="20"/>
                    </td>
                </tr>
                
                <!-- Address -->
                <tr>
                    <td>Address: </td>
                    <td>
                        <input type="text"  name="address" required  size="40"/>
                    </td>
                </tr>
                
                <!-- Tax Number -->
                <tr>
                    <td>Tax Number: </td>
                    <td>
                        <input type="text" pattern="{9}\d+" required name="tax_number" />
                    </td>
                </tr>
                <!-- Email -->
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" required name="email" />
                    </td>
                </tr>
                
                <!-- Company Name -->
                <tr>
                    <td>Company Name:</td>
                    <td>
                        <input type="text" required name="comname" value="" size="20"/>
                    </td>
                </tr>
                <!-- Website -->
                <tr>
                    <td>Web site: </td>
                    <td>
                        <input type="text" name="website" value="" size="20"/>
                    </td>
                </tr>
                
                <!-- Submit and Reset buttons -->
                <tr>
                    <td></td>
                    <td>
                    <input type="submit" name="Submit" value="Insert"/>  <input type="reset" name="Reset" value="Reset"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
