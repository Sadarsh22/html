<?php
            error_reporting(E_ALL);
            include 'login_credentials.php';
            $conn = new mysqli($hostname, $username, $password, 'adarsh');
            $curr_id = $_REQUEST['id'];
            $delQuery =  "UPDATE customer SET deleted=1 WHERE id=$curr_id";
            mysqli_query($conn, $delQuery);

            header("Location:http://10.10.10.17/listings.php#");
?>