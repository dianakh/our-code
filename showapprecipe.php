 <?php
$con=mysqli_connect("localhost","root","","project");
    $user = $_GET['key'];
$i= "SELECT title,id,image,totalrating,totalratingpeople FROM recipe where user_key='$user'";
//$row = mysqli_fetch_array(mysqli_query($con,$i));
$r = $con->query($i);
$result = array();
while($row = mysqli_fetch_array($r))
{
$totalrating=$row['totalrating'];
$totalratingpeople=$row['totalratingpeople'];
if($totalratingpeople=='0' and $totalrating=='0')
{
$rating='0';
}
else
 {
$rating=$totalrating/$totalratingpeople;
}
$im = file_get_contents('androidimages/'.$row['image']);
 $imdata = base64_encode($im);
    array_push($result,array(
        'id'=>$row['id'],
        'title'=>$row['title'],
        'image'=>$imdata,
         'rating'=>$rating,
    ));
}
echo json_encode(array('result'=>$result));
mysqli_close($con);
?>