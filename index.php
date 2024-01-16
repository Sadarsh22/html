<?php 

        $mode = $_REQUEST['mode'];

        if($_REQUEST['mode'] == 'edit')
        {
            // ini_set('display_errors', 1);
            // ini_set('display_startup_errors', 1);
            // error_reporting(E_ALL);
            include 'login_credentials.php';
            $conn = new mysqli($hostname, $username, $password, 'adarsh');
            $curr_id = $_REQUEST['id'];
            $query =  "Select * from customer WHERE id=$curr_id";
            $query_result = mysqli_query($conn, $query);

            $query_data = mysqli_fetch_assoc($query_result);
            
            $first_name = $query_data['first_name'];
            $last_name = $query_data['last_name'];
            $address_value = $query_data['address'];
            $email_id = $query_data['email'];
            $phn_id = $query_data['phone'];
            $gndr_id = $query_data['gender'];
            $dob_id = $query_data['date_of_birth'];
            $lang_id = $query_data['language'];
            $lang_id = explode(" ",$lang_id);
            $country_id = $query_data['country'];
            $file_name_id = $query_data['file_name'];

            // $dob = explode('-',$dob_id);
            // print $dob1= '13/01/2024'; //$dob[2].'/'.$dob[1].'/'.$dob[0];

            // echo($country_id);
            
        }

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body>

    <?php

    // include 'login_credentials.php';
    //  ini_set('display_errors',1);
    //  ini_set('display_startup_errors',1);
     error_reporting(E_ALL);

    $fname = $_REQUEST['First_Name'];
    $lname = $_REQUEST['Last_Name'];
    $addr = $_REQUEST['address'];
    $email = $_REQUEST['email'];
    $phn = $_REQUEST['Phone'];
    $gndr = $_REQUEST['Gender'];
    echo($gndr_id);
    $dob = $_REQUEST['dob'];
    $lng = $_REQUEST['Language'];
    $cnt = $_REQUEST['Country'];
    $fl = $_REQUEST['File'];
    $pswd = md5($_REQUEST['password']);
    $cnfpswd = md5($_REQUEST['confirmPassword']);

    $datecreated = date('Y-m-d').' '.date("h:i:sa");

    $currentDirectory = getcwd();
    $uploadDirectory = "/uploads/";

    $fileName = $_FILES['File']['name'];
    echo "img is->$fileName";
    $fileTmpName  = $_FILES['File']['tmp_name'];
    $fileExtension = strtolower(end(explode('.', $fileName)));

    $newFileName = rand() . time() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory .  $newFileName;

    // $files = glob('uploads/*');
    // foreach($files as $f)
    // {
    //   if(is_file($f))
    //   {
    //     unlink($f);
    //   }
    // }

    if (isset($_POST['Submit'])  && $mode !='edit' ) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    }

    if (isset($_POST['Submit'])  && $mode !='edit') {
        // Create connection
        $conn = new mysqli($hostname, $username, $password, 'adarsh');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // $email_sql = "select email from customer";
        // $email_arr = mysqli_num_rows($conn->query($email_sql));
        
        // foreach($email_arr as $val)
        // {
        //     if($val == $email)
        //     echo('<script>

        //     alert("hello");
        //     $("#SEmail").html("Email field should not be empty");
        //     $("#email").focus();
        //     $("#email").keypress(function () {
        //       $("#SEmail").hide();
        //     });
        
        //     </script>');
        // }

        $selectedLng = implode(' ',$lng);

        echo "Connected successfully";
        $sql = "INSERT INTO customer(`created_on_date`,`modified_on_date`,`first_name`, `last_name`, `address`, `email`, `phone`, `gender`, `date_of_birth`, `language`, `country`, `file_name`, `password`) 
          VALUES ('$datecreated','$datecreated','$fname','$lname','$addr','$email','$phn','$gndr','$dob','$selectedLng','$cnt','$newFileName','$pswd')";

        if ($conn->query($sql) === TRUE) {
            echo "record inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        header("Location:http://10.10.10.17/listings.php#");
    }



    if (isset($_POST['Submit']) && $mode =='edit') {
        // Create connection
        $conn = new mysqli($hostname, $username, $password, 'adarsh');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $selectedLng = implode(' ',$lng);

        echo "Connected successfully";

        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        $sql = "UPDATE
            `customer`
        SET
            `modified_on_date` = '$datecreated',
            `first_name` = '$fname',
            `last_name` = '$lname',
            `address` = '$addr',
            `email` = '$email',
            `phone` = '$phn',
            `gender` = '$gndr',
            `date_of_birth` = '$dob',
            `language` = '$selectedLng',
            `country` = '$cnt',
            `file_name` = '$newFileName'
        WHERE

        id=$curr_id";
    

        if ($conn->query($sql) === TRUE) {
            echo "record inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        // echo("<script>
        // windows.location.href='listings.php';
        // </script>");
        // header("Location:http://10.10.10.17/listings.php#");
    }

    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <script src="js/validationUsingJquery.js"></script> -->
    <?php
    if(!$_REQUEST['mode'] == 'edit')
    echo('<script src="js/validationUsingJquery.js"></script>');
    ?>
    
    
    <form name="applicationForm" id="applicationForm" method="post" enctype="multipart/form-data" action="">
        <table border="2" bordercolor="orange" align="center">
            <th colspan="2">Application Form</th>
            <tr>
                <td align="middle">First_Name</td>
                <td>
                    <input type="text" name="First_Name" id="First_Name" value="<?php if($mode == 'edit'):?><?php echo $first_name ?><?php endif; ?>" />
                    <br />
                    <span id="SFirst_Name"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Last_Name</td>
                <td>
                    <input type="text" name="Last_Name" id="Last_Name" value="<?php if($mode == 'edit'):?><?php echo $last_name ?><?php endif; ?>" />
                    <br />
                    <span id="SLast_Name"></span>
                </td>
            </tr>
            <tr>
                <td align="middle" valign="top">Address</td>
                <td>
                    <textarea name="address" id="address">  <?php if($mode == 'edit'):?><?php echo $address_value ?><?php endif; ?> </textarea>
                    <br />
                    <span id="SAddress"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Email</td>
                <td>
                    <input type="email" name="email" id="email" value="<?php if($mode == 'edit'):?><?php echo $email_id ?><?php endif; ?>" />
                    <br />
                    <span id="SEmail"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Phone</td>
                <td>
                    <input type="text" name="Phone" id="Phone" value="<?php if($mode == 'edit'):?><?php echo $phn_id ?><?php endif; ?>" />
                    <br />
                    <span id="SPhone"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Gender</td>
                <td>
                    <input type="radio" name="Gender" class="Gender" value="Male" <?php 
                    if($mode == 'edit')
                    {
                        if($gndr_id == 'Male'):?> checked <?php endif;
                    }
                    ?>  />Male
                    <input type="radio" name="Gender" class="Gender"  value="Female" <?php 
                    if($mode == 'edit')
                    {
                        if($gndr_id == 'Female'):?> checked <?php endif;
                    } 
                    ?>/>Female
                    <br />
                    <span id="SGender"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Date of Birth</td>
                <td>
                    <input type="date" id="dob" name="dob" value="<?php echo $dob_id; ?>"/>
                    <br />
                    <span id="SDob"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Language</td>
                <td>
                    <input type="checkbox" name="Language[]" class="Language" value="English" <?php 
                    if($mode == 'edit')
                    {
                        foreach($lang_id as $v)
                        if($v == 'English'):?> checked <?php endif; 
    
                    }
                    ?>/>English
                    <input type="checkbox" name="Language[]" class="Language" value="Hindi" <?php 
                     if($mode == 'edit')
                    {
                        foreach($lang_id as $v)
                        if($v == 'Hindi'):?> checked <?php endif; 
                    }
                    ?>/>Hindi
                    <input type="checkbox" name="Language[]" class="Language" value="Bengali" <?php 
                    if($mode == 'edit')
                    {
                        foreach($lang_id as $v)
                        if($v == 'Bengali'):?> checked <?php endif;
                    } 
                    ?>/>Bengali
                    <br />
                    <span id="SLanguage"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Country</td>
                <td>
                    <select name="Country">
                        <?php 
                            if($mode != 'edit')
                            echo("<option id='Country' >--Select--</option>");
                            else
                            echo "<option checked='checked' value=$country_id>$country_id</option>";
                        
                            $country_list = array("japan", "india", "nepal", "china", "usa", "canada", "Russia");

                            foreach ($country_list as $item) {
                                echo "<option value=$item>$item</option>";
                            }
                        ?>
                    </select>
                    <br />
                    <span id="SCountry"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">File</td>
                <td>
                    <input type="file" name="File" id="File" value="<?php $file_name_id ?>" src="uploads/<?php $file_name_id ?>"/>
                    <br />
                    <span id="SFile"></span>
                    <?php 

                        if($mode == 'edit')
                        {
                            echo("<td>
                            <img src='uploads/$file_name_id' height='100px' width='100px'>
                            </td>");
                        }

                    ?>
                </td>
            </tr>
            <tr>
                <td align="middle">Password</td>
                <td>
                    <input type="password" name="password" id="password" value="" />
                    <br />
                    <span id="SPassword"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Confirm Password</td>
                <td>
                    <input type="password" name="confirmPassword" id="confirmPassword" value="" />
                    <br />
                    <span id="SConfirmpassword"></span>
                </td>
            </tr>
            <th colspan="2">
                <a href="listings.php"><button type="button">back</button></a>
                <input type="submit" name="Submit" id="submit" value="Submit" />
                <input type="button" name="Reset" id="reset" value="Reset" />
            </th>
        </table>
    </form>
</body>

</html>