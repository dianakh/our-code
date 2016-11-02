<?php
require "conn.php";
header('Content-Type: bitmap; charset=utf-8');
$user=$_POST['user'];
$image = $_POST['image'];
$nameimage = $_POST['nameimage'];
$decodedImage = base64_decode($image);
//upload the image
    file_put_contents("profileimages/".$nameimage.".jpg", $decodedImage);
    $imagename="".$nameimage.".jpg";
$result1 ="update project set image='$imagename' where email='$user' ";

$res = mysqli_query($conn,$result1);
if (mysqli_affected_rows($conn)==0) {
  echo "Affected rows (UPDATE): %d\n", mysqli_affected_rows($conn);
}
else
 {
echo "updated succefully";
}



?>
