<?php
            error_reporting(E_ALL);
            include 'login_credentials.php';
            $conn = new mysqli($hostname, $username, $password, 'adarsh');
            $curr_id = $_REQUEST['id'];
            $result =  "Select * from customers WHERE id=$curr_id";
            mysqli_query($conn, $result);
?>

