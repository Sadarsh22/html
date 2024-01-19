<?php 
        include 'login_credentials.php';
        $conn = new mysqli($hostname, $username, $password, 'adarsh');
        $msg = '';
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);

        $mode = $_REQUEST['mode'];

        if($_REQUEST['mode'] == 'edit')
        {
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
        }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <?php

    $fname = $_REQUEST['First_Name'];
    $lname = $_REQUEST['Last_Name'];
    $addr = $_REQUEST['address'];
    $email = $_REQUEST['email'];
    $phn = $_REQUEST['Phone'];
    $gndr = $_REQUEST['Gender'];
    // echo($gndr_id);
    $dob = $_REQUEST['dob'];
    $lng = $_REQUEST['Language'];
    $cnt = $_REQUEST['Country'];
    $fl = $_REQUEST['File'];
    $pswd = md5($_REQUEST['password']);
    $cnfpswd = md5($_REQUEST['confirmPassword']);

    $datecreated = date('Y-m-d').' '.date("h:i:s");

    $currentDirectory = getcwd();
    $uploadDirectory = "/uploads/";

    $fileName = $_FILES['File']['name'];
    $fileTmpName  = $_FILES['File']['tmp_name'];
    $fileExtension = strtolower(end(explode('.', $fileName)));

    $newFileName = rand() . time() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory .  $newFileName;

    if (isset($_POST['Submit'])  && $mode !='edit') {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        
        //email server side validation
        $email = $_REQUEST['email'];
        echo($email);
        $email_query = "select email from customer where deleted = 0 and email='$email'";
        $emailQueryResult=mysqli_query($conn,$email_query);
        $emailquery_data = mysqli_fetch_assoc($emailQueryResult);
        if($emailquery_data) echo("email found in db".$emailquery_data);
        if($emailquery_data)
        {
            $msg = 'email already exists';
           
        }


        $selectedLng = implode(' ',$lng);

        $sql = "INSERT INTO customer(`created_on_date`,`modified_on_date`,`first_name`, `last_name`, `address`, `email`, `phone`, `gender`, `date_of_birth`, `language`, `country`, `file_name`, `password`) 
          VALUES ('$datecreated','$datecreated','$fname','$lname','$addr','$email','$phn','$gndr','$dob','$selectedLng','$cnt','$newFileName','$pswd')";

        $conn->query($sql);
        header("Location:http://10.10.10.17/listings.php#");
    }


    if (isset($_POST['Submit']) && $mode =='edit') {

        $selectedLng = implode(' ',$lng);

        echo "Connected successfully";

        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        $sql='';

        if(!$fileName)
        {
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
                `country` = '$cnt'
            WHERE
            id=$curr_id";
        }
        else
        {
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
            id='$curr_id'";
        }

        $conn->query($sql);
        echo "record inserted successfully";
        header("Location:http://10.10.10.17/listings.php#");
    }

    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <?php

    if(!$_REQUEST['mode'] == 'edit')
    echo('<script src="js/validationUsingJquery.js"></script>');
    else
    include 'verify.php';
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
                    <textarea name="address" id="address"><?php if($mode == 'edit'):?><?php echo trim($address_value) ?><?php endif; ?></textarea>
                    <br />
                    <span id="SAddress"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Email</td>
                <td>
                    <input type="email" name="email" id="email" value="<?php if($mode == 'edit'):?><?php echo $email_id ?><?php endif; ?>" />
                    <br />
                    <span id="SEmail"><?php print $msg; ?></span>
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
                    <select name="Country" id='Country'>
                        <?php 
                            if($mode != 'edit')
                            echo("<option  >--Select--</option>");
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
                    <input type="file" name="File" id="File" value="<?php $fileName ?>" src="uploads/<?php $fileName ?>"/>
                    <br />
                    <span id="SFile"></span>
                    <?php 

                        if($mode == 'edit')
                        {
                            echo("<td id='imageName'>
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