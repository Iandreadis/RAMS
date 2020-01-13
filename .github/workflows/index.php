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
        <title>RAMS - Product list</title>
    </head>
    <body>
        <!-- Include page header -->
        <?php include 'header.php';?>
        
        
        <h3 style="text-align: center; vertical-align: middle;">Welcome to Andreadis Audiovisual online shop</h3>
        
        <div  style="max-width:80%; height: 550px;margin: auto">
          <img class="mySlides" src="images/slide1.jpg" style="width:100%">
          <img class="mySlides" src="images/slide2.jpg" style="width:100%">
          <img class="mySlides" src="images/slide3.jpg" style="width:100%">
        </div>

        <script>
        /* Script has been taken from http://www.w3schools.com/w3css/w3css_slideshow.asp */
            
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
               x[i].style.display = "none";  
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}    
            x[myIndex-1].style.display = "block";  
            setTimeout(carousel, 4000); // Change image every 4 seconds
        }
        </script>
        
        
        <!-- Include page footer -->
        <?php include './footer.php';?>
    </body>
</html>
