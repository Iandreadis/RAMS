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
        <title>RAMS - Login Error</title>
    
    <link href="styles/styles.css" rel="stylesheet" type="text/css">
    <script>
    function goBack() {
        window.history.back()
    }

    function goLogin() 
    {
        window.location.href = "index.php";
    }

    function goHome() 
    {
        window.location.href = "index.php";
    }
    </script>
</head>

<body>
    <div class="message">
        <h1>RAMS</h1>
        <br>
        
        <?php
            $ErrorID = $_GET['msgid'];
            switch ($ErrorID) 
            {
                case 1:
                    $MessageText = "Your login information is not correct.<br><br>".
                                   "Please type your username and password carefully.<br>";
                    echo "<p class=\"ErrorText\">".$MessageText."</p>";
                    echo "<p style=\"text-align:  center; margin-top:  3em;\"><button type=\"button\" onclick=\"goBack()\" style=\"margin-left: auto; margin-right: auto; text-align: center; width: 100px; height: 36px; background-color: #4d9ddb; color: #fff;\">OK</button></p>";
                    break;
                case 2:
                    $MessageText = "The page you tried to visit requires login.<br><br>".
                                   "Please login to RAMS and try again.<br>";
                    echo "<p class=\"ErrorText\">".$MessageText."</p>";
                    echo "<p style=\"text-align:  center; margin-top:  3em;\"><button type=\"button\" onclick=\"goLogin()\" style=\"margin-left: auto; margin-right: auto; text-align: center; width: 100px; height: 36px; background-color: #4d9ddb; color: #fff;\">OK</button></p>";
                    break;
            }
        ?>
    </div>
</body>
</html>