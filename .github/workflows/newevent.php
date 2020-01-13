<?php
    include "includes/config.php";
    include "includes/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link href="styles/styles.css" rel="stylesheet" type="text/css" />
        <title>RAMS - New Conference</title>
        
        <!--Include JQuery libs for datepicker and timepicker-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.4/jquery.timepicker.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.4/jquery.timepicker.min.js"></script>
        
        <script>
        $(function() {
          $( "#startTime" ).timepicker({ timeFormat: 'HH:mm' });
        });
        
        $(function() {
          $( "#endTime" ).timepicker({ timeFormat: 'HH:mm' });
        });
        
        $(function() {
          $( "#startDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });
        
        $(function() {
          $( "#endDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });
        
        </script>
  
    </head>
    <body>
        <!-- Include page header -->
        <?php include 'header.php';?>
        <p></p>
        <h1>New conference</h1>
        
        <!-- HTML form to insert new conference data-->
        <?php
            $cust_info = file_get_contents(WEB_SERVER.'api.php?action=get_customers');
            // json_decode function decodes JSON data and produces an associative array

            $cust_info = json_decode($cust_info, true);
        ?>
        
        <form name="edit" action="api.php?action=set_new_conference" method="POST" enctype="multipart/form-data">
            
            
            <table id="conf_info_table">
                <!-- Conference title -->
                <tr>
                    <td>Conference title:</td>
                    <td>
                        <input type="text" required name="name" value="" size="30"/>
                    </td>
                </tr>
                <!-- Conference location -->
                <tr>
                    <td>Location: </td>
                    <td>
                        <input type="text" required name="location" value="" size="30"/>
                    </td>
                </tr>
                <!-- Start date -->
                <tr>
                    <td>Starts on: </td>
                    <td>
                        Date: <input type="date" required name="start" value="" id="startDate" style="width: 100px"/> Time:<input type="date" required name="startTime" value="" id="startTime" style="width: 80px" />
                    </td>
                </tr>
                <!-- Finish date -->
                <tr>
                    <td>Finished on: </td>
                    <td>
                        Date: <input type="date" required name="end" value="" id="endDate" style="width: 100px"/> Time:<input type="date" required name="endTime" value="" id="endTime" style="width: 80px"/>
                    </td>
                </tr>
                <!-- Product description -->
                <tr>
                    <td>Description: </td>
                    <td>
                        <input type="text" required name="description" value="" size="40"/>
                    </td>
                </tr>
                <!-- Customer selection from drop-down list -->
                <tr>
                    <td>Customer: </td>
                    <td>
                        <select name="customer_id">
                                <?php
                                foreach ($cust_info as $key => $value) 
                                { 
                                        echo "<option value=\"".$cust_info[$key]['customer_id']."\">".$cust_info[$key]['cust_lastname']." ".$cust_info[$key]['cust_name']."</option>";
                                }
                                ?>
                        </select>
                    </td>
                </tr>
                <!-- Event Manager -->
                <tr>
                    <td>Event Manager: </td>
                    <td><input type="text" name="event_manager" ></td>
                </tr>
                
                <!-- Audience description -->
                <tr>
                    <td>Audience: </td>
                    <td>
                        <textarea rows="4" cols="50" name="audience"></textarea>
                    </td>
                </tr>
                <!-- Submit and Reset buttons -->
                <tr>
                    <td></td>
                    <td>
                        <a href="#products_table"><input type="button" value="Next Step"/> </a>
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <h3 id="products_table">Select products for the conference:</h3>
            
            
            <!--    Show all employees        -->
            <?php
                // get_products of RAMS API returns a JSON file
                $prod_info = file_get_contents(WEB_SERVER.'api.php?action=get_products');
                
                // json_decode function decodes JSON data and produces an associative array
                $array_info = json_decode($prod_info, true);
            ?>
            
            <!--HTML table to display product data-->
            <table style='width: 100%;'>
                
            <!--Column headers-->
            <tr>
            <td style='padding: 12px;'><strong>Item code</td><td style='padding: 12px;'><strong>Photo</td><td style='padding: 12px;'><strong>Item name</td><td style='padding: 12px;'><strong>Available</td><td style='padding: 12px;'><strong>Information</td><td style='padding: 12px;'><strong>Quantity</strong></td>
            </tr>

            <?php
                $i=0;
                // Iterate products array and create table rows to display item data
                foreach ($array_info as $key => $value) 
                { 
                    // Display product only if stock is over 0
                    if($value['prod_stock'] > 0)
                    {
                        echo "<tr>";
                        $i++;

                        $in_basket_id = $value['id'];
                        echo "<td>".$value['id']."</td>";
                        echo "<td><img class='prod_image' src='photos/".$value['prod_image']."' alt='Product Image' height='80'/></td>";
                        echo "<td>".$value['prod_name']."</td>";
                        echo "<td>".$value['prod_stock']."</td>";
                        echo "<td>".$value['prod_info']."</td>";

                        // Order quantity input field
                        echo "<td style='padding: 12px;'>";
                        echo "<input type='number' name='prod_quan_".$i."' value='0' size='3' min='0' max='".$value['prod_stock']."' step='1' style='width: 40px;'\>";
                        

                        // The hidden field "in_basket_prod_id" passes the item_id to the "in_basket" function
                        echo "<input type='hidden' name='prod_id_".$i."' value='$in_basket_id' \>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }   

            ?>
            </table>
            
            <!--Next step button-->
            <hr><a href="#employees_table"><input type="button" value="Next Step"/> </a>
            <br>
            <br>
            
            <!--    Show all employees        -->
            <?php
                // get_employess of RAMS API returns a JSON file
                $employee_info = file_get_contents(WEB_SERVER.'api.php?action=get_employees');
                
                // json_decode function decodes JSON data and produces an associative array
                $employees = json_decode($employee_info, true);
            ?>
            
            <br>
            <h3 id="employees_table">Select employees for the conference:</h3>
            
            <!--HTML table to display employee data-->
            <table style='width: 100%;'>
                
            <!--Column headers-->
            <tr>
                <td style='padding: 12px;'><strong>Lastname</td><td style='padding: 0px;'><strong>Firtsname</td><td style='padding: 0px;'><strong>Specialty</td><td style='padding: 0px;'><strong>SSN</td><td style='padding: 0px;'><strong>Tax Number</td><td style='padding: 0px;'><strong>Phone</td><td style='padding: 0px;'><strong>Email</td><td style='padding: 0px;'><strong>Address</strong></td><td></td>
            </tr>

            <?php
                $i=0;
                // Iterate employees array and create table rows to display item data
                foreach ($employees as $key => $value) 
                { 
                    echo "<tr>";
                    $i++;

                    echo "<td>".$value['em_lastname']."</td>";
                    echo "<td>".$value['em_firstname']."</td>";
                    echo "<td>".$value['specialty']."</td>";
                    echo "<td>".$value['socialsecuritynumber']."</td>";
                    echo "<td>".$value['tax_number']."</td>";
                    echo "<td>".$value['phone']."</td>";
                    echo "<td>".$value['e_mail']."</td>";
                    echo "<td>".$value['address'];

                    // The input checkbox field employee id
                    echo "</td>";
                    echo "<td> <input type='checkbox' name='emp_id_".$i."' value='".$value['employee_ID']."' \>";
                    echo "</tr>";
                }   

            ?>
            </table>
            
            <!--Next step button-->
            <hr><div><input type='submit' name='Submit' value='Submit Conference'></div>
            
            
        </form>
        
        <!-- Include page footer -->
        <?php include './footer.php';?>
        
        
    
    </body>
</html>
