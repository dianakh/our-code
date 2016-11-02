<?php 
require "conn.php";
$id = $_POST["id"];
$new=$_POST["new"];

$result ="select location from project where face_id='$id'";
$name = mysqli_query($conn,$result);
while($row = mysqli_fetch_array($name))
{
 if($row['location']==$new){
	echo "No changes";
}
else{
$result1 ="update project set location='$new' where face_id='$id'";

$res = mysqli_query($conn,$result1);
if (mysqli_affected_rows($conn)==0) {
  echo "Affected rows (UPDATE): %d\n", mysqli_affected_rows($conn);
}
else
 {
echo "updated succefully";
}
}

}
?>