<!-- Script that connects user to the server and database (start user session) -->
<?php
    /* Settings are configured to work within the development environment (XAMPP) */
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "inventory";
    $conn = mysqli_connect($serverName, $userName, $password, $dbName);
    if(!$conn){
        /* Display error message if there is a problem with connecting to the server */
        die("Connection error: " . mysqli_connect_error());
    }
?>