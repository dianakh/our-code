<?php 
require "conn.php";
$title = $_POST["title"];
$sql = "select type,user_key,face_id from recipe where title='$title'";
$res = mysqli_query($conn,$sql);
$result = array();
while($row = mysqli_fetch_array($res)){
if($row[1]!== '')
{
array_push($result,
array('chif_type'=>$row[0],
	'chif_appid'=>$row[1],
	'chif_faceid'=>"noid"
	));
}
else{

array_push($result,
array('chif_type'=>$row[0],
	'chif_appid'=>"noid",
	'chif_faceid'=>$row[2]
	));
}
}

echo json_encode(array("result"=>$result));
mysqli_close($conn);
?>
