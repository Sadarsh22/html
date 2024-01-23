<?php
ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
if(isset($_REQUEST['submit']))
{
$name = $_REQUEST['name'];
$filename = $_FILES['myfile']['name'];
include_once('conn.php');
$insert_query = "INSERT INTO `demo`(`name`, `img`) VALUES ('$name','$filename')";
mysqli_query($conn, $insert_query);


$currentDirectory = getcwd();
$uploadDirectory = "/uploads/";
$filename = $_FILES['myfile']['name'];
$fileTmpName  = $_FILES['myfile']['tmp_name'];
$fileExtension = strtolower(end(explode('.', $filename)));

$newFileName = rand() . time() . '.' . $fileExtension;

$uploadPath = $currentDirectory . $uploadDirectory .  $newFileName;

move_uploaded_file($fileTmpName,$uploadPath);

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="validate.js"></script>
</head>

<body>
    <form id="form" action="" method="post" style="margin-top: 50px;" enctype="multipart/form-data">

        <table id='mytable' align="center" cellpadding='4' cellspacing='4' border='1'>
            <tr>
                <th colspan="2" style="text-align: center;">Application Form</th>
            </tr>
            <tr>
                <td>Full Name</td>
                <td><input type="text" id="name" name="name" class="name" placeholder="please enter the name" /></td>
            </tr>
            <tr>
                <td>Profile picture</td>
                <td><input type="file" name="myfile" id="myfile" /></td>
            </tr>
            <th colspan="2" style="text-align: center;">
                <a href="display.php"><button type="button" >back</button></a>
                <a href="display.php"><input type="submit" name="submit" id="submit" value="submit"></a>
            </th>
        </table>

    </form>
</body>

</html>