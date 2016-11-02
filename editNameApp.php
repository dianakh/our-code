<?php 
require "conn.php";
$user = $_POST["user"];
$new=$_POST["new"];
$exist="";
$result0 ="select name from project where name='$new' ";
$names = mysqli_query($conn,$result0);
if(mysqli_num_rows($names)>0){
	$exist="This name already exist choose another one";

}
else{
	$exist="not exist";
}


if($exist=="not exist"){

$result1 ="update project set name='$new' where email='$user' ";

$res = mysqli_query($conn,$result1);
if (mysqli_affected_rows($conn)==0) {
  echo "Affected rows (UPDATE): %d\n", mysqli_affected_rows($conn);
}
else
 {
echo "updated succefully";
}
}

else{
	echo $exist;
}


?>