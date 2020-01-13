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
        <?php include 'header.php'; ?>
        <p></p>
        <h1>New item</h1>
        <form name="edit" action="api.php?action=set_new_product" method="POST" enctype="multipart/form-data">
            <table>
                <!-- Model number -->
                <tr>
                    <td>Model number:</td>
                    <td>
                        <input type="text" required name="model_number" value="" size="20"/>
                    </td>
                </tr>
                <!-- Item model -->
                <tr>
                    <td>Model: </td>
                    <td>
                        <input type="text" required name="model" value="" size="40"/>
                    </td>
                </tr>
                <!-- Product name -->
                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text" required name="name" value="" size="40"/>
                    </td>
                </tr>
                <!-- Product stock quantity  -->
                <tr>
                    <td>Stock: </td>
                    <td>
                        <input type="number" name="stock" value="1" min="1"step="1" size="40"/>
                    </td>
                </tr>
                <!-- Product description -->
                <tr>
                    <td>Description: </td>
                    <td>
                        <input type="text" name="description" value="" size="40"/>
                    </td>
                </tr>
                <!-- File select and upload form field -->
                <tr>
                    <td>Photo: </td>
                    <td>
                        <input type="file" required name="prod_photo" id="prod_photo"/>
                    </td>
                </tr>                
                <!-- ΚSubmit and Reset buttons -->
                <tr>
                    <td></td>
                    <td>
                    <input type="submit" name="Submit" value="Submit"/>  <input type="reset" name="Reset" value="Reset"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
