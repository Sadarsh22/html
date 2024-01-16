<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP File Upload</title>
</head>

<?php

    // error_reporting(E_ALL);
    // ini_set('display_errors',1);

    $currentDirectory = getcwd();
    $uploadDirectory = "/uploads/";

    $fileName = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $newFileName = rand().'_'.basename($fileName);

    $uploadPath = $currentDirectory . $uploadDirectory . $newFileName; 
    // $folder_path = $uploadPath; 
   
    // List of name of files inside 
    // specified folder 
    $files = glob('uploads/*');  
    
    // Deleting all the files in the list 
    foreach($files as $s) { 
    
        if(is_file($s))  
        
            // Delete the given file 
            unlink($s);  
    } 

    if (isset($_POST['submit'])) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    }
?>




<body>
    <form action="" method="post" enctype="multipart/form-data">
        Upload a File:
        <input type="file" name="the_file" id="fileToUpload">
        <input type="submit" name="submit" value="Start Upload">
    </form>
</body>
</html>