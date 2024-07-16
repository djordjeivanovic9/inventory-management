<!-- Script to end user session -->
<?php
    session_start();
    unset($_SESSION['isLoggedIn']); /* Unset session variable */
    session_destroy();
    header("location: ../index.php"); /* Return to home page */
    exit;
?>