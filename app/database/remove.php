<!-- Script for deleting added entries from database table -->
<?php
    if(isset($_GET['id'])){
	    $id = $_GET['id'];
	    require 'connect.php';
	    $query = "DELETE FROM items WHERE id = {$id}";
	    mysqli_query($conn, $query);
	    header("Location: ../entryList.php"); /* Redirect to page after deletion of entry */
    } 
?>