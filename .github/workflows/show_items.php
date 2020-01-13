<?php
include "includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf8"/>
        <title>RAMS </title>
        </head>
<body>
<?php // include 'header.php';?>
<p></p>
<h1>
    Available products
</h1>
<?php
$prod_info=file_get_contents(WEB_SERVER.'items_api.php?action=get_items');
$projector_info=file_get_contents(WEB_SERVER.'items_api.php?action=get_projectors');
$array_info=json_decode($prod_info,true);
$array_info1=json_decode($projector_info,true);
echo "<table style=\"width:80%;\">";
echo "<tr>";
echo "<td style=\"padding: 12px;\"<strong>ID</strong></td><td style=\"padding: 12px;\"><strong>Name</strong></td>";
echo "</tr>";
foreach ($array_info as $key => $value)
{
    echo "<tr>";
    foreach($value as $k =>$v)

    {
        echo "<td style=\"padding : 12px;\">";
        echo $v;
        echo "</td>";
    }
    echo "</tr>";
}
foreach ($array_info1 as $key => $value)
{
    echo "<tr>";
    foreach($value as $k =>$v)

    {
        echo "<td style=\"padding : 12px;\">";
        echo $v;
        echo "</td>";
    }
    echo "</tr>";
}
?>
</body>
</html>

