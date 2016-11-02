<?php

//if($_SERVER['REQUEST_METHOD']=='GET'){
require "conn.php";
$_GET['title']='';
$_GET['calory']='34';
$_GET['total']='23';
$_GET['list']='BUTTER';

$title  = $_GET['title'];
$calory=$_GET['calory'];
$total= $_GET['total'];
$list= $_GET['list'];
	$result1 = array();	$result2 = array();	$result3 = array();	$result4 = array();
       if($title== '' &&  $calory== '' && $total=='' && $list=='')
       {
echo 'please fill the values';
}

else{

		if($_GET['title']!=''){
		$sql = "SELECT * FROM recipe WHERE title='".$title."'";
		
		$r = mysqli_query($conn,$sql);
		
		while($res = mysqli_fetch_array($r)){
		
		array_push($result1,array(
			"title"=>$res['title'],
			"calory"=>$res['calory'],
			"total"=>$res['total']
			)
		);
	}

			echo json_encode(array("result1"=>$result1));
	}
	else{	array_push($result1,array(
			"title"=>'',
			"calory"=>'',
			"total"=>''
			)
		);
}


	if($_GET['calory']!=''){
		$sql = "SELECT * FROM recipe WHERE calory='".$calory."'";
		

		$r = mysqli_query($conn,$sql);
		
		while($res = mysqli_fetch_array($r)){
		
	
		
		array_push($result2,array(
			"title"=>$res['title'],
			"calory"=>$res['calory'],
			"total"=>$res['total']
			)
		);
		
	}

echo "<br>";
		echo json_encode(array("result2"=>$result2));

}
else{	array_push($result2,array(
			"title"=>'',
			"calory"=>'',
			"total"=>''
			)
		);}

		if($_GET['total']!=''){
		$sql = "SELECT * FROM recipe WHERE total='".$total."'";
		
		$r = mysqli_query($conn,$sql);
		
		while($res = mysqli_fetch_array($r)){
		
	
		
		array_push($result3,array(
			"title"=>$res['title'],
			"calory"=>$res['calory'],
			"total"=>$res['total']
			)
		);
	}
	echo "<br>";
			echo json_encode(array("result3"=>$result3));
	}
	else{	array_push($result3,array(
			"title"=>'',  
	if($result1 !==''||$result2!=='' ||$result3!=='' ||$result4!==''){
  

$arr3 = array_uintersect($result2, $result3,function ($e1, $e2) { 
    if($e1===$e2) {
        return 0;
    } else {
        return 1;
    }
});
echo "<br>";
	echo json_encode(array("result"=>$arr3));

	}
     else{echo "no such result";}

}

		mysqli_close($conn);

//}

?>
