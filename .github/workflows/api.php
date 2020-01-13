<?php
    ob_start();
    include "includes/config.php";
    include "includes/functions.php";

// Gets all employees allocated for the conference
function get_conf_emps()
{
    global $conn;

    $ev_id = $_GET['event_id'];
    
    $employees = array();
    
    // SQL SELECT to retrieve the required columns of the em_employees table
    $sql = "SELECT em_employees.employee_id, em_employees.em_firstname, em_employees.socialsecuritynumber, em_employees.phone, em_employees.address, em_employees.tax_number, em_employees.specialty, em_employees.status, em_employees.e_mail, em_employees.em_lastname FROM em_employees INNER JOIN cf_emp_events ON cf_emp_events.employee_id = em_employees.employee_id WHERE cf_emp_events.event_id = '$ev_id'";
    
    // Execute SQL query by MySQL server
    $result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));
    
    // Create an associative array of the results
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $employees[] = array("employee_ID" => $row['employee_id'], "em_firstname" => $row['em_firstname'], "socialsecuritynumber" => $row['socialsecuritynumber'], "phone" => $row['phone'], "address" => $row['address'], "tax_number" => $row['tax_number'], "specialty" => $row['specialty'], "status" => $row['status'], "em_lastname" => $row['em_lastname'], "e_mail" => $row['e_mail'] );
    }
    
    // Return the results array
    return $employees;
}
    
// Gets all items allocated by the conference
function get_conf_items()
{
    global $conn;
	
    $ev_id = $_GET['event_id'];
    
    $prod_info = array();
    
    // SQL SELECT to retrieve the required columns of the PRODUCTS table
    $sql = "SELECT wh_items.item_id, wh_items.model_number, wh_items.model, wh_items.name, cf_items_events.quantity, wh_items.description FROM wh_items INNER JOIN cf_items_events  ON wh_items.item_id = cf_items_events.item_id  WHERE cf_items_events.event_id = '$ev_id'";
    
    // Execute SQL query by MySQL server
    $result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));
    
    // Create an associative array of the results
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $prod_info[] = array("id" => $row['item_id'], "prod_name" => $row['name'], "prod_stock" => $row['quantity'], "prod_info" => $row['description']);
    }
    // Return the results array
    return $prod_info;
}
    

// Inserts a product in the logged user's shopping basket
function refill_stock()
{
    global $conn;
	
    // Get POST data
    $i=0;
    $prod_quan_array;
    
    // For every input product id from form, search the corresponding product quantity
    foreach ($_POST as $key => $value) {
        
        
        // If key begins with prod_id_, then find also the quantity
        if( substr( $key, 0, 8 ) === "prod_id_" ) {
        
            $i++;
            
            // Search for the corresponding prod_quantity
            foreach ($_POST as $secondkey => $secondvalue) {

                if( $secondkey === ("prod_quan_".$i) && $secondvalue > 0 ) {
                    
                    // Add to the associative array (prod_id, prod_quantity) => (value,secondvalue)
                    $prod_quan_array[$value] = $secondvalue;
                }
            }
        }
    }

    // Update database

    // For each key in $prod_quan_array
    foreach ($prod_quan_array as $key => $value)
    {   
        // Add quantity 
        $strSQL = "UPDATE wh_items SET quantity = quantity + '$value' WHERE item_id = '$key'";

        // Execute SQL
        $result = mysqli_query($conn, $strSQL);

       if (!$result)
           return (0);      // Error has been occured
   }
   
   return (1);      // No error
}
    
// get_suppliers returns an associative array of all suppliers
function get_suppliers()
{
    global $conn;
	
    $suppliers = array();
    
    // SQL SELECT to retrieve the required columns of the sp_suppliers table
    $sql = "SELECT supplier_ID, firstname, phone, address, tax_number, e_mail, lastname, company_name, website FROM sp_suppliers";
    
    // Execute SQL query by MySQL server
    $result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));
    
    // Create an associative array of the results
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $suppliers[] = array("supplier_id" => $row['supplier_ID'], "firstname" => $row['firstname'], "phone" => $row['phone'], "lastname" => $row['lastname'], "address" => $row['address'], "tax_number" => $row['tax_number'], "e_mail" => $row['e_mail'], "company_name" => $row['company_name'], "website" => $row['website'] );
    }
    
    // Return the results array
    return $suppliers;
}
   

// get_employees returns an associative array of all employees
function get_employees()
{
    global $conn;
	
    $employees = array();
    
    // SQL SELECT to retrieve the required columns of the em_employees table
    $sql = "SELECT employee_ID, em_firstname, socialsecuritynumber, phone, address, tax_number, specialty, status, e_mail, em_lastname FROM em_employees";
    
    // Execute SQL query by MySQL server
    $result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));
    
    // Create an associative array of the results
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $employees[] = array("employee_ID" => $row['employee_ID'], "em_firstname" => $row['em_firstname'], "socialsecuritynumber" => $row['socialsecuritynumber'], "phone" => $row['phone'], "address" => $row['address'], "tax_number" => $row['tax_number'], "specialty" => $row['specialty'], "status" => $row['status'], "em_lastname" => $row['em_lastname'], "e_mail" => $row['e_mail'] );
    }
    
    // Return the results array
    return $employees;
}
    
// Sets new supplier
function set_new_supplier()
{
    global $conn;
    if(isset($_POST))
    {
        // Get POST array data
        $firstname=$_POST['firstname'];
        $lastname = $_POST['lastname'];
        $comname = $_POST['comname'];
        $website = $_POST['website'];
        $address  = $_POST['address'];

        $phone = $_POST['phone'];
        $tax_number = $_POST['tax_number'];
        $email = $_POST['email'];


        // First check if company name already exists
        $strSQL="SELECT * FROM sp_suppliers WHERE company_name = '$comname'";
        // Execute SQL query by MySQL server
        $result = mysqli_query($conn, $strSQL);

        // If there is no row for this specific company name, then proceed to set supplier
        if(mysqli_num_rows($result) == 0){


            // Insert supplier to sp_suppliers table
            // Form SQL query
            $strSQL="INSERT INTO sp_suppliers( firstname, phone, address, tax_number, e_mail, lastname, company_name, website)".
                                    " VALUES ('$firstname','$phone','$address','$tax_number','$email','$lastname', '$comname', '$website')";

            // Execute SQL query by MySQL server
            $result = mysqli_query($conn, $strSQL);

            //Successful insertion. Return 1
            return ("1");
        }
        else {   // Company name already exists

            //Insertion failed. Return 0
            return ("0");
        }
    }
}
    
// Searches and returns the search results
function search_product()
{
    global $conn;

    // Get search text from GET method
    $st = $_GET['st'];
    
    $prod_info = array();
    
    // SQL SELECT to retrieve the required columns of the PRODUCTS table
    $sql = "SELECT wh_items.item_id, wh_items.model_number, wh_items.model, wh_items.name, wh_items.quantity, wh_items.description, wh_itemimages.filename ".
            "FROM wh_items INNER JOIN wh_itemimages ".
            "ON wh_items.item_id = wh_itemimages.item_id ".
            "WHERE wh_items.name LIKE '%$st%' OR wh_items.description LIKE '%$st%' ".
            "ORDER BY model";

    // Execute SQL query by MySQL server
    $result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));
    
    // Create an associative array of the results
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $prod_info[] = array("id" => $row['item_id'], "prod_image" => $row['filename'], "prod_name" => $row['name'], "prod_stock" => $row['quantity'], "prod_info" => $row['description']);
    }
    
    // Return the results array
    return $prod_info;
}
    
// Sets new product
function set_new_product()
{
    global $conn;
    if(isset($_POST))
    {
       $model_number=$_POST['model_number'];
       $model=$_POST['model'];
       $name=$_POST['name'];
       $description=$_POST['description'];
       $stock = $_POST['stock'];
    //   $category=$_POST['category'];
       $target_dir="photos/";
       $target_file=$target_dir.basename($_FILES["prod_photo"]["name"]);
       $uploadOk=1;
       $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

        $check=getimagesize($_FILES["prod_photo"]["tmp_name"]);
        if($check !==false ) 
        {
                echo "Picture uploaded -" . $check["mime"] . ".";
                $upload = 1;
        }
        else
        {
                echo "This is not a picture.";
                $uploadOk=0;
        }

        if($imageFileType!="jpg" && $imageFileType!="png" && $imageFileType!="jpeg"&& $imageFileType!="gif")
        {
                echo "Only files JPG,JPEG,PNG & GIF. The photo cannot be uploaded";
                $upload=0;
                return ;
        }
        else
        {
             if(move_uploaded_file($_FILES["prod_photo"]["tmp_name"],$target_file))
             {
                 echo "The file".basename($_FILES["prod_photo"]["name"])."has been uploaded.";
             }
             else
             {
                 echo "Error uploading.";
             }
         }

         $strSQL="INSERT INTO wh_items (model_number, model, name, description, quantity) VALUES ('$model_number', '$model', '$name', '$description', '$stock')";

        // Execute SQL query by MySQL server
         $result = mysqli_query($conn, $strSQL);

         // Return proper message
         if ($result && $upload == 1)
         {
                     $last_id = mysqli_insert_id($conn);
                     $bsName = basename($_FILES["prod_photo"]["name"]);
                     $strSQL="INSERT INTO wh_itemimages (item_id, filename) VALUES ($last_id, '$bsName')";
                     $result = mysqli_query($conn, $strSQL);
             return ("The new item inserted succesfully.");
         }
         else {
             return (mysqli_error($conn));
         }
    }
}

// Customer buys products
function buy()
{
    global $conn;
    if(isset($_POST))
    {
        // Get POST array data
        $id = $_POST['id'];

        // Empty basket
        $strSQL="DELETE FROM basket WHERE cust_id = '$id'";
        
        // Execute SQL query by MySQL server
        $result = mysqli_query($conn, $strSQL);
        
        return 1;
    }
}

// Register new user
function register_new_customer()
{
    
    global $conn;
    if(isset($_POST))
    {
        // Get POST array data
        $firstname=$_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $address  = $_POST['address'];

        $ssn = $_POST['ssn'];
        $phone = $_POST['phone'];
        $tax_number = $_POST['tax_number'];
        $email = $_POST['email'];


        // First check if username already exists
        $strSQL="SELECT * FROM users WHERE usr_username = '$username'";
        // Execute SQL query by MySQL server
        $result = mysqli_query($conn, $strSQL);

        // If there is no row for this specific username, then proceed to register
        if(mysqli_num_rows($result) == 0){


            // Insert user to user table
            // Form SQL query
            $strSQL="INSERT INTO users(usr_username, usr_password, usr_admin) VALUES ('$username','$password', 0)";

            // Execute SQL query by MySQL server
            $result = mysqli_query($conn, $strSQL);

            // Insert user also to customers table
            // Form SQL query
            $strSQL="INSERT INTO cm_customers( firstname, socialsecuritynumber, phone, address, tax_number, specialty, status, e_mail, lastname)".
                                    " VALUES ('$firstname','$ssn','$phone','$address','$tax_number','-','0','$email','$lastname')";

            // Execute SQL query by MySQL server
            $result = mysqli_query($conn, $strSQL);

            //Successful registering. Proceed to login return 1
            return ("1");
        }
        else {   // Username already exists

            //Registering failed. Username already exists, return 0
            return ("0");
        }
    }
    
}

// Create a new conference entry
function set_new_conference()
{
    global $conn;
    if(isset($_POST))
    {
        // Get POST array data for new conference
        $name=$_POST['name'];
        $location=$_POST['location'];
        $startDate=$_POST['start'];
        $endDate=$_POST['end'];

        $startTime=$_POST['startTime'];
        $endTime=$_POST['endTime'];

        $customer_id=$_POST['customer_id'];
        $audience=$_POST['audience'];
        $event_manager=$_POST['event_manager'];

        // Form full datetimes
        $fullStartDateTime = $startDate.' '.$startTime;
        $fullEndDateTime = $endDate.' '.$endTime;


        // Get POST data for all products that have beed allocated
        $prod_quan_array;

        // For every input product id from form, search the corresponding product quantity
        foreach ($_POST as $key => $value) {


            // If key begins with prod_id_, then find also the quantity
            if( substr( $key, 0, 8 ) === "prod_id_" ) {

                $i++;

                // Search for the corresponding prod_quantity
                foreach ($_POST as $secondkey => $secondvalue) {

                    if( $secondkey === ("prod_quan_".$i) && $secondvalue > 0 ) {

                        // Add to the associative array (prod_id, prod_quantity) => (value,secondvalue)
                        $prod_quan_array[$value] = $secondvalue;
                    }
                }
            }
        }


        // Get POST data for all employees that have beed allocated
        $employee_array;

        // For every input employee id from form
        foreach ($_POST as $key => $value) {

            // If key begins with emp_id_, it means that the checkbox is checked
            if( substr( $key, 0, 7 ) === "emp_id_" ) {

                $employee_array[$key] = $value;
            }
        }
        

        // Execute SQL query
        $strSQL = "INSERT INTO cf_events ( name, location, start, end, customer_id, audience, event_manager)
                   VALUES ('$name', '$location', '$fullStartDateTime', '$fullEndDateTime', '$customer_id', '$audience', '$event_manager')";

        // Execute SQL query by MySQL server
        $result = mysqli_query($conn, $strSQL);

        // Get event_id 
        $event_id = mysqli_insert_id($conn);
        
        if($result){
                
            // Insert into cf_items_events all products that have been allocated
            foreach ($prod_quan_array as $key => $value) {

                $prod_id = $key;
                $prod_quan = $value;
                
                // Execute SQL query
                $strSQL = "INSERT INTO cf_items_events (event_id, item_id, quantity)
                           VALUES ('$event_id', '$prod_id', '$prod_quan')";

                // Execute SQL query by MySQL server
                $result = mysqli_query($conn, $strSQL);
                
                
                // Subtract quantity of product from wh_items
                $strSQL = "UPDATE wh_items SET quantity = quantity - $prod_quan WHERE item_id = '$prod_id'";
                
                // Execute SQL
                $result = mysqli_query($conn, $strSQL);
            }
            
            // Insert into cf_items_events all products that have been allocated
            foreach ($employee_array as $key => $value) {

                $emp_id = $value;
                
                // Execute SQL query
                $strSQL = "INSERT INTO cf_emp_events  ( employee_id ,  event_id )
                           VALUES ('$emp_id', '$event_id')";

                // Execute SQL query by MySQL server
                $result = mysqli_query($conn, $strSQL);
            }
            
            return 1;
        }
    }
    
    return 0;
}

// get_conferences returns an associative array of all events ordered by start date
function get_conferences()
{
    global $conn;
	
    $event_info = array();
    
    // SQL SELECT to retrieve the required columns of the joined table
    $sql = "SELECT cf_events.event_id, cf_events.start, cf_events.end, cf_events.name, cf_events.location, cm_customers.firstname, cm_customers.lastname, cf_events.event_manager
			FROM cm_customers INNER JOIN cf_events ON cm_customers.customer_ID = cf_events.customer_id
			ORDER BY cf_events.start DESC;";
    
    // Execute SQL query by MySQL server
    $result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));
    
    // Create an associative array of the results
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $event_info	[] = array("event_id" => $row['event_id'],"start" => $row['start'], "end" => $row['end'], "name" => $row['name'], "location" => $row['location'], "firstname" => $row['firstname'], "lastname" => $row['lastname'], "event_manager" => $row['event_manager']);
    }
    
    // Return the results array
    return $event_info;
}

// get_products returns an associative array of all products ordered by (prod_name)
function get_products()
{
    global $conn;
	
    $prod_info = array();
    // SQL SELECT to retrieve the required columns of the PRODUCTS table
    $sql = "SELECT wh_items.item_id, wh_items.model_number, wh_items.model, wh_items.name, wh_items.quantity, wh_items.description, wh_itemimages.filename FROM wh_items INNER JOIN wh_itemimages ON wh_items.item_id = wh_itemimages.item_id ORDER BY model";
	// Execute SQL query by MySQL server
	$result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));
    // Create an associative array of the results
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $prod_info[] = array("id" => $row['item_id'], "prod_image" => $row['filename'], "prod_name" => $row['name'], "prod_stock" => $row['quantity'], "prod_info" => $row['description']);
    }
    // Return the results array
    return $prod_info;
}

// get_customers returns array of all customers ordered by lastname
function get_customers()
{
	global $conn;

	$cust_info = array();
	// SQL query to retrieve data from the cm_customers table ordered by lastname
	$sql = "SELECT customer_id, lastname, firstname FROM cm_customers ORDER BY lastname";
	// Query execution
	$result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));
	// Create the results associative array
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$cust_info[] = array("customer_id" => $row['customer_id'], "cust_lastname" => $row['lastname'], "cust_name" => $row['firstname']);
	}
	// Returns the associative array
	return $cust_info;
}

// *******************************************************************************
//
// Function: do_login();
// Receives POST data and validates user credentials
//
// *******************************************************************************
function do_login()
{
	global $conn;
	
    // Gets a POST array from the login HTML form
    // Escapes characters for username & password variables
    $username = mysqli_escape_string($conn, $_POST['username']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    // Creates a user object
    $LoggedUser = new User();
    // SQL query to retrieve a username & password pair in the USERS table
    $sql = "SELECT * FROM users WHERE Usr_Username = '$username' AND Usr_Password = '$password'";
	echo $sql;
    $result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));
    // If a single record is retrieved then a session cookie is created, holding the logged user id χρήστη, name and a flag
    if (mysqli_num_rows($result) == 1) 
    {
        $row = mysqli_fetch_array($result);
        $_SESSION['authorized'] = true;
        $_SESSION['LoggedUserID'] = $row['usr_id'];
        $_SESSION['LoggedName'] = $row['usr_username'];

        $Logged_ID = $LoggedUser->GetLoggedUser();
        $AdminAccess = $LoggedUser->IsAdmin($Logged_ID);
            
        header("Location: listproducts.php");
        return TRUE;
    } 
    else 
    {
        $_SESSION['error'] = 'Wrong username or password';
        header("Location: message.php?msgid=1");
        return FALSE;
    }
}

// *******************************************************************************
//
// Function: do_logoff();
// Logs a user off and destroys the session cookie
//
// *******************************************************************************
function do_logoff()
{
    session_unset(); 
    // Destroys session data and deletes the session cookie
    session_destroy();             
    return TRUE;
} 


// Inserts a product in the logged user's shopping basket
function in_basket()
{
	global $conn;
	
    // Get POST data
    // User ID 
    $user_id = $_POST['in_basket_user_id'];
    
    $i=0;
    $prod_quan_array;
    
    // For every input product id from form, search the corresponding product quantity
    foreach ($_POST as $key => $value) {
        
        
        // If key begins with prod_id_, then find also the quantity
        if( substr( $key, 0, 8 ) === "prod_id_" ) {
        
            $i++;
            
            // Search for the corresponding prod_quantity
            foreach ($_POST as $secondkey => $secondvalue) {

                if( $secondkey === ("prod_quan_".$i) && $secondvalue > 0 ) {
                    
                    // Add to the associative array (prod_id, prod_quantity) => (value,secondvalue)
                    $prod_quan_array[$value] = $secondvalue;
                }
            }
        }
    }

    // Update database

    // For each key in $prod_quan_array
    foreach ($prod_quan_array as $key => $value)
    {   
       // SQL query to insert record in basket
       $strSQL = "INSERT INTO basket (prod_id, cust_id, quantity) VALUES ($key, $user_id, $value)"
               . " ON DUPLICATE KEY UPDATE quantity = quantity+'$value'";
       
       // Execute SQL
       $result = mysqli_query($conn, $strSQL);
       
       // Return message
       if ($result)
       {
           // Subtract quantity 
           $strSQL = "UPDATE wh_items SET quantity = quantity - $value WHERE item_id = '$key'";
           // Execute SQL
           $result = mysqli_query($conn, $strSQL);
       }
       else
           return ("Error: ".mysqli_error($conn));
   }
   
   return ("Item added to your basket.");   
}


// get_basket gets a user ID as parameter and returns an
// array of ordered items
function get_basket($uid)
{
	global $conn;
	
    // SQL query to retrieve BASKET table columns where cust_id equals customer ID 
    $strSQL = "SELECT wh_items.name, basket.quantity
                FROM basket
                INNER JOIN wh_items ON basket.prod_id = wh_items.item_id
                WHERE basket.cust_id =$uid";
    $result = mysqli_query($conn, $strSQL) or die('Could not access your basket. ' . mysqli_error($conn));
    
    // Create the results associative array 
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $prod_info[] = array("name" => $row['name'], "quantity" => $row['quantity']);
    }
    return $prod_info;
}


// possible_url is an array with valid API function names that can be called via the uri
$possible_url = array("get_conf_emps",
                    "get_conf_items",
                    "refill_stock",
                    "get_suppliers",
                    "set_new_supplier",
                    "search_product",
                    "buy",
                    "set_new_product",
                    "register_new_customer",
                    "set_new_conference",
                    "get_conferences",
                    "get_employees",
                    "do_login",
                    "do_logoff",
                    "get_products",
                    "get_customers",
                    "in_basket",
                    "get_basket");

// Initialize $value.
// $value gets the value returned by the corresponding function
$value = "An error has occurred";

// Checks the URI passed to the API (through the GET array), 
// to retrieve the requested function.
// Checks array possible_url and if the function belongs to it
// it is executed
if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
{

    switch ($_GET["action"])
    {
        // Gets the employees allocated for the conference
        case "get_conf_emps":
            $value = get_conf_emps();
            break;        
        // Gets the items allocated for the conference
        case "get_conf_items":
            $value = get_conf_items();
            break;
        // Refill stock of products
        case "refill_stock":
            $value = refill_stock();
            header("Location: refill_stock.php?msg=".$value);
            break;
        // Get all suppliers
        case "get_suppliers":
            $value = get_suppliers();
            break;
        // Set new supplier
        case "set_new_supplier":
            $value = set_new_supplier();
            header("Location: new_supplier.php?msg=".$value);
            break;
        // Search for the keyword
        case "search_product":
            $value = search_product();
            break;
        // Buy products that located in the basket
        case "buy":
            $value = buy();
            header("Location: listbasket.php?msg=".$value);
            break;
        // Register new user
        case "register_new_customer":
            $value = register_new_customer();
            header("Location: registerCustomer.php?msg=".$value);
            break;
        // Create new item
        case "set_new_product":
            $value = set_new_product();
            header("Location: listproducts.php");
            break;
        // Create new conference
        case "set_new_conference":
            $value = set_new_conference();
            header("Location: listevents.php");
            break;
        // Login and create a session cookie
        case "do_login":
            $value = do_login();
            echo "RESULT: ".$value;
            break;
        // Logoff and destroy session cookie
        case "do_logoff":
            $value = do_logoff();
            // displayed the index page
            header("Location: index.php");
            break;
        // Returns an array of all available products
        case "get_products":
            $value = get_products();
            break;        
        // Returns an array of all scheduled events (conferences
        case "get_conferences":
            $value = get_conferences();
            break;        
        // Return the customers array 
        case "get_customers":
            $value = get_customers();
            break;
        case "get_employees":
            $value = get_employees();
            break;
        // Inserts item into the shopping basket
        case "in_basket":
            $value = in_basket();
            // Display the basket page
            header("Location: listbasket.php");
            break;
        // Returns an array containing the basket contents for user with id uid
        case "get_basket":
            if (isset($_GET["uid"]))
                $value = get_basket($_GET["uid"]);
            break;                   
        }
}

// Each function result is encoded as a JSON array
exit(json_encode($value));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link href="styles/styles.css" rel="stylesheet" type="text/css" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
