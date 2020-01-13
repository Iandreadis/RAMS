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
        <title>RAMS - Register</title>
    </head>
    <body>
        <!-- Include page header -->
        <?php include 'header.php'; ?>
        <p></p>
        <h1>New item</h1>
        
        <!-- Display message if exists -->
        <?php
        if(isset( $_GET["msg"] ) ){
            
            // If one, then all fine
            if($_GET["msg"] === "1")
                echo '<p style="color:black">Successful registering. Proceed to <a href="login.php">login</a></p>';
            else
                echo '<p style="color:black">Registration failed. Username already exists</p>';
        }
        ?>
        
        <form name="edit" action="api.php?action=register_new_customer" method="POST">
            <table>
                
                <!-- UserName -->
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" required name="username" value="" size="20"/>
                    </td>
                </tr>
                <!-- Password -->
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" required name="password" value="" size="20"/>
                    </td>
                </tr>
                
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
                <!-- Social Security Number -->
                <tr>
                    <td>SSN: </td>
                    <td>
                        <input type="text" pattern="[0-9]{9}" required name="ssn" value="" size="20"/> (nine digits)
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
                
                <!-- ΚSubmit and Reset buttons -->
                <tr>
                    <td></td>
                    <td>
                    <input type="submit" name="Submit" value="Register"/>  <input type="reset" name="Reset" value="Reset"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
