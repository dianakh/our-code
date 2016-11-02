<?php 
require "conn.php";


  $sql = "select * from calory";
 
  $res = mysqli_query($conn,$sql);


$sql = "SELECT * FROM calory";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 
 // output data of each row
 while($row[] = $result->fetch_assoc()) {
 
 $json = json_encode($row);
 
 
 }
} else {
 echo "0 results";
}
echo $json;
$conn->close();

?>