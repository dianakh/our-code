<?php 
require "conn.php";
$email =  $_POST["user"];
$sql = "select name,gender,email,image,phone,location from project where email='$email' || name='$email'";
$res = mysqli_query($conn,$sql);
$result = array();
while($row = mysqli_fetch_array($res)){
	$im = file_get_contents('profileimages/'.$row['image']);
 $imdata = base64_encode($im);
array_push($result,
array('name'=>$row['name'],
	'gender'=>$row['gender'],
	'email'=>$row['email'],
	'image'=>$imdata,
	'phone'=>$row['phone'],
	'location'=>$row['location']
	
));
}
echo json_encode(array("result"=>$result));
mysqli_close($conn);
?>
