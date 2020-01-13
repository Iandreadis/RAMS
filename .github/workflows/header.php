<!--
This page creates the header snd menu of the RAMS eShop.
Any page that needs a header must include header.php
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    
    <style type="text/css">
        
        /* Gradient background - support for all browsers */
        #headerStyle {
            background: #4084b9; /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(#000000, #4084a0); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(#000000, #4084a0); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(#000000, #4084a0); /* For Firefox 3.6 to 15 */
            background: linear-gradient(#000000, #4084a0); /* Standard syntax */
            
            width: 100%;
            background-color: #4084b9;
            color: white;
            padding-right:  20px;
            border-bottom-right-radius: 20px;
            border-bottom-left-radius: 20px;
        }
        
    </style>
    
    <body>
        <table id="headerStyle">
            <tr>
                <td>
                    <a href="index.php"><img src="images/logo.png" style="border-radius: 20px;" alt="RAMS"/></a>
                </td>
                <td>
                <?php
                    //Create an Object of classUser
                    $LoggedUser = new User();
                    
                    // Retrieves the logged user id in the session cookie
                    $in_basket_user_id = $LoggedUser->GetLoggedUser();
                    
                    // Retrieves if the logged user is an administrator
                    $AdminAccess = $LoggedUser->IsAdmin($in_basket_user_id);
                    
                    // Create the page header
                    // Displays the logged user name and a Logoff button
                    echo "<form action=\"".WEB_SERVER."api.php?action=do_logoff\" method=\"POST\" enctype=\"multipart/form-data\">";
                    if ($LoggedUser->GetLoggedUsername() != "Guest")
                    {
                        echo "<p class='logged'>Welcome ".$LoggedUser->GetLoggedUsername();            
                        echo "<br><input type=\"submit\" value=\"Logoff\" style=\"border: 0px;  background-color: #4d9ddb; color: #ffffff; border-radius: 10px; \"/>";
                    }
                    echo "</form>";
                ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <?php
                    // The menu is formed according the logged user rights
                    $strMenu = "<td style='width:  50px;'><a href='index.php'>Home</a></td><td> | </td>";
                    // In case the logged user has administrative rights($AdminAccess = 1) 
                    // a "New item" choice is available and displayed
                    if ($AdminAccess == 1)
                    {
                        $strMenu .= "<td style='width:  100px;'><a href='listproducts.php'>View products</a></td><td> | </td>";
                        $strMenu .= "<td style='width:  70px;'><a href='newproduct.php'>New item</a></td><td> | </td>";
                        $strMenu .= "<td style='width:  110px;'><a href='newevent.php'>New conference</a></td><td> | </td>";
                        $strMenu .= "<td style='width:  90px;'><a href='listevents.php'>Conferences</a></td><td> | </td>";
                        $strMenu .= "<td style='width:  100px;'><a href='show_suppliers.php'>View suppliers</a></td><td> | </td>";
                        $strMenu .= "<td style='width:  90px;'><a href='new_supplier.php'>New Supplier</a></td><td> | </td>";
                        $strMenu .= "<td style='width:  90px;'><a href='refill_stock.php'>Refill Stock</a></td>";
                    }
                    // Form the menu bar
                    // Open the online shop menu choice only for non admin
                    if ($in_basket_user_id != 0 && $AdminAccess != 1){
                        $strMenu .= "<td  style='width:  80px;'><a href='shop.php'>Shop now</a></td><td> | </td>";
                    }
                    
                    if ($in_basket_user_id == 0){
                        $strMenu .= "<td style='width:  100px;'><a href='listproducts.php'>View products</a></td><td> | </td>";
                        $strMenu .= "<td style='width:  60px;'><a href='login.php'>Login</a></td><td> | </td>";
                        $strMenu .= "<td style='width:  80px;'><a href='registerCustomer.php'>Register</a></td>";
                    }
                    
                    // Display basket menu choice  only for non admin
                    if ($in_basket_user_id != 0 && $AdminAccess != 1)
                        $strMenu .= "<td style='width:  80px;'><a href='listbasket.php'>Your basket</a></td>";
                    
                    echo $strMenu;
                ?>

                <td></td>
                <td>
                    <div  style="text-align: right;">
                        <form method="POST" action="search_results.php">
                            <input type="search" name="searchtext" placeholder="Search Product" style="height: 32px; vertical-align: bottom; border-radius: 20px;" />
                            <input type="submit" value="" style="vertical-align: bottom; background-image:url('images/search_button.png'); width: 32px; height: 32px; border: 0px; border-radius: 20px;"/>
                    </form>
                    </div>
                </td>
                
            </tr>
            
        </table>
    </body>
</html>
