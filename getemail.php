<?php 
require "conn.php";
$email = $_POST["name"];
$sql = "select email from project where email='$email' || name='$email'";
$res = mysqli_query($conn,$sql);
$result = array();
while($row = mysqli_fetch_array($res)){
array_push($result,
array(
	'email'=>$row[0]	
));
}
echo json_encode(array("result"=>$result));
mysqli_close($conn);
?>
