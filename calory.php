<?php 
require "conn.php";
$calory = $_POST["calory"];

$mysql_qry =  "insert into calory values ($calory)";
$result = mysqli_query($conn ,$mysql_qry);

if($result) {
echo "success";
}
else {
echo "not success";
}

?>