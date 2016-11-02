<?php 
require "conn.php";
$id = $_POST["id"];
$mysql_qry="insert into facebook (id,name,gender,picture) values ('$id','$name','$gender','$pictur')";
$result =$conn->query($mysql_qry);

if($result === TRUE) {
echo "success";
}
else {
echo "Error: " . $mysql_qry . "<br>" . $conn->error;
}

?>