<?php
include "includes/config.php";

?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset"utf-8"/>
    <link href="styles/styles.css" rel="stylesheet" type="text/css"/>
    <title>RAMS</title>
</head>
<body>
<p>

</p>
<h1>
    New Product
</h1>
<form name="edit" action ="items_api.php?action=set_new_products" method="POST" enctype="multipart/form-data">;
      <table>
          <tr>
              <td>Product:</td>
              <td>
                  <input type="text" name ="prod_name" value ="" size="20"/>
              </td>
          </tr>
          <tr>
              <td>Description:</td>
              <td>
                  <input type="text" name ="prod_description" value ="" size="40"/>
              </td>
          </tr>
          <tr>
              <td>Value:</td>
              <td>
                  <input type="number" name ="prod_value" value ="0" min="0" step="any"/>
              </td>
          </tr>
          <tr>
              <td>Image:</td>
              <td>
                  <input type="file" name ="prod_image"id="prod_photo"/>


              </td>
          </tr>
      </table>
</form>
</body>
</html>