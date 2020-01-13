<?php
ob_start();
include "includes/config.php";

function get_items()
{
    global $conn;
    $prod_info = array();
    $sql = "SELECT*FROM wh_items";
    //echo $sql;
    $result = mysqli_query($conn, $sql) or die('Query failed.' . mysqli_error($conn));
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        //   echo $row['name'];
        $prod_info[] = array("id" => $row['item_id'], "item_name" => $row['name']);
    }
    return $prod_info;
}
function get_projectors()
    {
        global $conn;

        $projector_info = array();
        $sql1 = "SELECT*FROM wh_projectors";
        $result1 = mysqli_query($conn, $sql1) or die('Query failed.' . mysqli_error($conn));


        while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
            $projector_info[] = array("id" => $row['proj_id'], "item_name" => $row['name']);
        }
        return $projector_info;
    }


$possible_url = array("get_items","get_projectors");
$value="An error has occured";
if(isset($_GET["action"]) && in_array($_GET["action"],$possible_url))
{
  //  echo"1";
    switch($_GET["action"])
    {
        case "get_items";
         //   echo"2";
            $value=get_items();
            break;
        case "get_projectors";
            $value=get_projectors();
        break;
    }
}
exit(json_encode($value));