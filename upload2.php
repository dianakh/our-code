<?php
require "conn.php";
// Where the file is going to be placed
$video=$_FILES['uploadedfile']['name'];
$target_path = "upload/";
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
 
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo basename( $_FILES['uploadedfile']['name']);
   
} 
else
{

    echo "There was an error";
  
   
}


?>