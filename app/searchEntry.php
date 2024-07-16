<!-- Check session validity and return to the home page if the user is not logged in -->
<?php 
    session_start();
    if (!isset($_SESSION['isLoggedIn'])) {   /* Check if the session variable is present */
        header("location: index.php");
        exit;
    }
?>
<html>
    <head>
        <title>Inventory Management System</title>
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
        <div id="wrap">
            <!-- Toolbar that contains logout link and current date and time -->
            <div id="toolbar">
                <div id="close">
                    <a href="database/disconnect.php"><img src="images/logout.svg" title="Log Out"></a>
                </div>
                <div id="time">
                    <?php
                        date_default_timezone_set("Europe/Belgrade");
                        echo date("d.m.Y • H:i");
                    ?>
                </div>
            </div>
            <img src="images/icon.svg">
            <p>Inventory Management System</p>
            <!-- Pressing the button opens entry list page -->
            <button onclick="window.location.href='entryList.php'">Show entry list</button>
            <br></br>
            <p><b>Search items</b></p>
            <div id="search">
                <!-- Search entry form -->
                <form action="#" method="GET">
                    <input type="text" name="criteria" placeholder="Search by ID, name, ...">
                    <button type="submit" value="Search">Search</button><br/>
                </form>
            </div>
            <!-- Call to the script that displays data -->
            <?php include "database/results.php"; ?>
        </div>
    </body>
</html>