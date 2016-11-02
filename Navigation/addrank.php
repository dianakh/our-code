<?php 
require "conn.php";
$rank = $_POST["rank"];
$recipe = $_POST["recipe"];
$conn->query("update recipe set rank='$rank' where recipe='$recipe'");
if($conn->affected_rows>0){
echo"Thank you";
}
else{echo"not success";}



?>