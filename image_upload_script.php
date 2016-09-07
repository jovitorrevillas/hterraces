<?php include "templates/include/header.php" ?>
 <?php
// Access the $_FILES global variable for this specific file being uploaded and create local PHP variables from the $_FILES array of information
   $fileName = $_FILES["uploaded_file"]["name"]; 
   $fileTmpLoc = $_FILES["uploaded_file"]["tmp_name"];
   $fileType = $_FILES["uploaded_file"]["type"]; 
   $fileSize = $_FILES["uploaded_file"]["size"]; 
   $fileErrorMsg = $_FILES["uploaded_file"]["error"]; 
   $fileName = preg_replace('#[^a-z.0-9]#i', '', "logo.png"); 
   $kaboom = explode(".", $fileName); 
   $fileExt = end($kaboom); 
if (!$fileTmpLoc) { 
 // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
} else if($fileSize > 5242880) { 
 // if file size is larger than 5 Megabytes
    echo "ERROR: Your file was larger than 5 Megabytes in size.";
    unlink($fileTmpLoc); 
    exit();
} else if (!preg_match("/.(png)$/i", $fileName) ) {
     // This condition is only if you wish to allow uploading of specific file types    
     echo "ERROR: Your image was not .png.";
     unlink($fileTmpLoc);
     exit();
} else if ($fileErrorMsg == 1) { 
 // if file upload error key is equal to 1
    echo "ERROR: An error occured while processing the file. Try again.";
    exit();
}
// Place it into  "uploads" folder using the move_uploaded_file() function
$moveResult = move_uploaded_file($fileTmpLoc, "images/$fileName");
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    echo "ERROR: File not uploaded. Try again.";
    exit();
}
// Display things to the page so you can see what is happening for testing purposes
echo "The file named <strong>$fileName</strong> uploaded successfuly.<br /><br />";
echo "It is <strong>$fileSize</strong> bytes in size.<br /><br />";
echo "It is an <strong>$fileType</strong> type of file.<br /><br />";
echo "The file extension is <strong>$fileExt</strong><br /><br />";
echo "The Error Message output for this upload is: $fileErrorMsg";
?>

<?php include "templates/include/footer.php" ?>
