<!-- Check session validity and return to the home page if the user is not logged in -->
<?php 
    session_start();
    if (!isset($_SESSION['isLoggedIn'])) {  /* Check if the session variable is present */
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
            <p><b>Add new entry</b></p>
            <div id="search">
                <!-- Add new entry form -->
                <form action="#" method="POST">
                    <label>Item ID:<br />
				    <input type="text" name="iidn"></label>
                    <br><br/>
				    <label>Item name:<br />
				    <input type="text" name="name"></label>
                    <br><br/>
				    <label>Item type:<br/>
				    <input type="text" name="type"></label>
                    <br><br/>
				    <label>Item mark:<br/>
				    <input type="text" name="mark"></label>
                    <br><br/>
                    <button type="submit" name="add" value="Add new entry">Add entry</button><br/>
			    </form>
            </div>
            <?php 
                if(isset($_POST['add'])){  /* Record entry data in database table when "Add new entry" button is pressed */
                    if(isset($_POST['iidn']) && isset($_POST['name']) && isset($_POST['type']) && isset($_POST['mark'])){  /* Record data only when all criteria are entered */
                        if(!empty($_POST['iidn']) && !empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['mark'])){
                            /* Clear entered text from all fields */
                            $iidn = trim($_POST['iidn']);
                            $name = trim($_POST['name']);
                            $type = trim($_POST['type']);
                            $mark = trim($_POST['mark']);
                            require 'database/connect.php';  /* Call to functionality in another script */
                            $iidn = mysqli_real_escape_string($conn, $iidn);
                            $name = mysqli_real_escape_string($conn, $name);
                            $type = mysqli_real_escape_string($conn, $type);
                            $mark = mysqli_real_escape_string($conn, $mark);
                            /* Record entry in the database table according to the entered criteria */
                            $query = "INSERT INTO items (iidn, name, type, mark) VALUES ('{$iidn}','{$name}','{$type}','{$mark}')";
                            if(mysqli_query($conn, $query) == TRUE){  /* Display message if entry was successfully recorded */
                                echo "New item added successfully.";
                            }else{
                                echo "Error.";
                            }
                        }else{
                            echo "All fields must be filled."; /* Display error message when fields are not filled */
                        }
                    }else{
                        echo "Error.";
                    }
                }
            ?>
        </div>
    </body>
</html>