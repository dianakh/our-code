<?php 
  

require "conn.php";
//$name = $_GET["recipeName"];
$name ="apple";

//$result1 =$conn->query("SELECT * FROM recipe where title='$name'");

//$num_rows = $result1->num_rows;
//echo $num_rows;
//if($num_rows==0){
$resource = $conn->query("SELECT * FROM recipe where title='$name'");
if ( !$resource ) die('Database Error: '.$conn->error);
while ( $row = $resource->fetch_assoc() ) {
    echo "{$row['title']}";
    echo "<br>";
    echo "{$row['calory']}";
    echo "<br>";
    echo "{$row['descc']}";
      echo "<br>";
       echo "{$row['list']}";
       echo "<br>";
        echo "{$row['total']}";
    echo "<br>";
       echo "{$row['prep']}";
       echo "<br>";
        echo "{$row['cook']}";
     
$pic='androidimages/'.$row['image'];


      
}
$resource->free();
$conn->close();
//}
//else{echo "Error: <br>" . $conn->error;}

?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

	   
	   	<img id="c3" src="<?php echo $pic; ?>" alt="" height="100" width="100" />

</body>
</html>