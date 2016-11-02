<?php 
header('Content-Type: bitmap; charset=utf-8');
require "conn.php";
$id = $_POST["id"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$email = $_POST["email"];
$picture = $_POST["picture"];

$result1 =$conn->query("SELECT face_id FROM project where face_id='$id'");
$num_rows = $result1->num_rows;
if($num_rows==0)
{
$mysql_qry="insert into project (face_id,name,gender,email,image) values ('$id','$name','$gender','$email','$picture')";
$result =$conn->query($mysql_qry);

if($result === TRUE)
 {
echo "success";
}
else
 {
echo "Error: " . $mysql_qry . "<br>" . $conn->error;
}

}
else {
	echo"userexist";
}
?>