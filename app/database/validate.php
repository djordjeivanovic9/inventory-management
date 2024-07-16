<!-- Script that checks if the correct credentials are entered -->
<?php
    session_start(); 
    include_once('connect.php');
    /* Clear all text from input fields if the check fails */
    function test_input($data) {
        $data = trim($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);
        /* Check entered credentials against the table on the server */
        $query = "SELECT * FROM admins";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->get_result();
        $data = $resultSet->fetch_all(MYSQLI_ASSOC);
        foreach($data as $user) {
            /* If the credentials are correct, set the session variable and then redirect to the main page */
            if(($user['username'] == $username) && ($user['password'] == $password)) {
                $_SESSION['isLoggedIn'] = true;  /* Session variable */
                header("location: ../entryList.php");
            }
            /* If the credentials are incorrect, reload the page and display error message */
            else {
                $_SESSION['error'] = array("Incorrect credentials.");
                header("location: ../index.php");
            }
        }
    }
?>