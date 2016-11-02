<?php 
require "conn.php";
$id = $_POST["id"];
$sql = "select name,gender,email,phone,location from project where face_id='$id'";
$res = mysqli_query($conn,$sql);
$result = array();
while($row = mysqli_fetch_array($res)){
array_push($result,
array('name'=>$row[0],
	'gender'=>$row[1],
	'email'=>$row[2],
	'phone'=>$row[3],
	'location'=>$row[4]

	
));
}
echo json_encode(array("result"=>$result));
mysqli_close($conn);
?>
