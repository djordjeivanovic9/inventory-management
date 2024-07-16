<html>
    <!-- Start session checking -->
    <?php session_start(); ?>
    <head>
        <title>Inventory Management System</title>
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
        <div id="wrap">
        <div id="toolbar">
                <div id="close"></div>
                <!-- Display current date and time -->
                <div id="time">
                    <?php
                        date_default_timezone_set("Europe/Belgrade");
                        echo date("d.m.Y • H:i");
                    ?>
                </div>
            </div>
            <img src="images/icon.svg">
            <p>Inventory Management System</p>
            <br></br>
            <p><b>Log In</b></p>
            <div id="search">
                <!-- Login form -->
                <form action="database/validate.php" method="post">
                    <label>Username:</label><br />
                    <input type="text" name="username">
                    <br><br />
                    <label>Password:</label><br />
                    <input type="password" name="password">
                    <br><br />
                    <button type="submit" name="login" value="login">Log In</button>
			    </form>
            </div>
            <!-- Display error message when incorrect credentials are entered -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error">
                    <?php foreach($_SESSION['error'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>