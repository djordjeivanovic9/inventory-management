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
        <!-- Toolbar that contains logout link and current date and time -->
        <div id="wrap">
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
            <button onclick="window.location.href='addEntry.php'">Add new entry</button>
            <br></br>
            <p><b>Search items</b></p>
            <div id="search">
                <!-- Search entry form -->
                <form action="searchEntry.php" method="GET">
                    <input type="text" name="criteria" placeholder="Search by ID, name, ...">
                    <button type="submit" value="Search">Search</button><br/>
                </form>
                <br />
                <p><b>Entry list</b></p>
                <!-- Display total number of entries (rows) in database table -->
                <?php
                    require "database/connect.php";
                    $mysqli = "SELECT * from items";
                    if ($result = mysqli_query($conn, $mysqli)){
                        $rowcount = mysqli_num_rows( $result );
                        printf("Total number of items in this inventory: %d\n", $rowcount);
                    }
                ?>
            </div>
            <!-- Display all data from database table with option to delete each entry separately -->
            <?php
                require "database/connect.php";
                $query = "SELECT DISTINCT * FROM items";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                            <table>
                                <tr><td>ID:</td><td>Name:</td><td>Type:</td><td>Mark:</td><td>Item</td></tr>
                                <tr>
                                    <td><?php echo $row["iidn"]; ?></td>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td><?php echo $row["type"]; ?></td>
                                    <td><?php echo $row["mark"]; ?></td>
                                    <td><a href="database/remove.php?id=<?php echo $row["id"] ?>"><img src="images/delete.svg" style="width: 30px;" title="Remove item"></a></td>
                                </tr>
                            </table>
                        <?php
                    } 
                /* Display "no data" message when there are no entries in database table */
                }else{
                    echo "No data.";
                }        
            ?>
        </div>
    </body>
</html>