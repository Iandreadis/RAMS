<?php

// User class
class User
{
    public $Usr_ID;
    public $Usr_Username;
    public $Usr_Password;
    public $Usr_Lastname;
    public $Usr_Firstname;
    public $Usr_Email;
    public $Usr_Phone;
    public $Usr_Mobile;
    public $Usr_Role_Admin;
    public $Usr_Role_Editor;
    public $Usr_Status;
    public $Usr_Prefs;

    public $User_List = array();
   
    // Retrieves the session cookie and gets the ID of the logged user
    function GetLoggedUser()
    {
        $LoggedID = 0;
       
        if (isset ($_SESSION['LoggedUserID']))
            $LoggedID = $_SESSION['LoggedUserID'];
        else
            $LoggedID = 0;
            
        return $LoggedID;
    }

    // Retrieves the session cookie and returns the username of the logged user
    function GetLoggedUsername()
    {
        if (isset ($_SESSION['LoggedUserID']))
            $LoggedUsr = $_SESSION['LoggedName'];
        else
            $LoggedUsr = "Guest";
        return $LoggedUsr;
    }

    // Retrieves the usr_admin column value of the USERS table for a specific user id
    function IsAdmin($ID)
    {
		global $conn;
        $ID = mysqli_real_escape_string($conn, $ID);
        $sql = "SELECT * FROM users WHERE Usr_ID=".$ID;
        $result = mysqli_query($conn, $sql);
        if ($result)
        {
            while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC))
            {
                $this->Usr_ID = $row['usr_id'];
                $this->Usr_Role_Admin = $row['usr_admin'];
            }
        }
        return $this->Usr_Role_Admin;
    }
}

?>

