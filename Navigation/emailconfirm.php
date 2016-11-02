
<?php
   session_start(); // Starting Session
   include("connectDB.php");//connect to database
   include("valid.php");// test validation
   if (! isset($_SESSION['csrf_token']))
	   {
    $_SESSION['csrf_token'] =  md5(uniqid(rand(), true));;
        }




	$db_code="";
	
$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("sweet home", $connection);


$code=$_GET['code'];
$username=$_GET['username'];
$code=trim($code);
$username=trim($username);

$query = mysql_query("SELECT * FROM member WHERE username='".$username."' ",$connection);


while($row = mysql_fetch_array($query))
{
    
	$db_code=$row['code'];

if($row['confirmed']=='1'){
	$state="conf";
	
}	
else{	

if($code=$db_code)
{


if($row['confirmed']=='0'){
	$state="notconf";
	mysql_query("UPDATE member SET confirmed=1 WHERE username='".$_SESSION['username']."'",$connection);
	mysql_query("UPDATE member SET code=0 WHERE username='".$_SESSION['username']."'",$connection);

}	
}
else{
	echo "there is some problem";
}


}

}

     if(isset($_REQUEST['submit'])!='')
    {
	
	  $valid =validation::validate_registration($_REQUEST['name'], $_REQUEST['password']);
	// Check a POST is valid.
      if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) 
	    {
		 	if($valid['state']==true) //test if validation successfull
            {
		  	$username=$_REQUEST['name'];

            $db = Database::getInstance();
            $mysqli = $db->getConnection(); 

	       $sql = $mysqli->prepare("SELECT * FROM member WHERE  username=? ");
           $sql->bind_param("s", $username );
           $sql->execute();
           $res = $sql->get_result();

           if($row = $res->fetch_assoc())
		   {
	
            if(password_verify($_REQUEST['password'],$row['password']))
               
			   {
	   
                        if($row['confirmed']==1)
                        {
	               $_SESSION["login_user"]=$username;
	   
	               $_SESSION["ID"]=$row['ID'];
	               header("location: welc.php");
                        }
						
                        else{$error="Your Account is NOT Activated ,please check you email ! ";}
                 } 
                 else 
				 {
				 $error = "Username or Password is invalid";
                  }
            }

             else
			  {
	          $error= "This username NOT exist please register first!";
              }

   
            }
        }
    }




//prevent injection
function test_input($data) {
	$data = mysql_real_escape_string($data);  //The function adds an escape character, the backslash, \,
// before certain potentially dangerous characters in a string passed in to the function
  $data = trim($data); //removes whitespace and other predefined characters from both sides of a string.
  $data = stripslashes($data);  //Remove the backslash:
  $data = htmlspecialchars($data);//Convert the predefined characters "<" (less than) and ">" (greater than) to HTML entities:
  return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!-- jquery validation plugin //-->

<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">  
  </script>

 <script>var $j = jQuery.noConflict(true);</script>
    <script>
      $(document).ready(function(){
       console.log($().jquery); // This prints v1.4.2
       console.log($j().jquery); // This prints v1.9.1
      });
   </script>


<script type="text/javascript">
    $j(window).load(function(){
	var st="<?php echo($state); ?>";
	if(st=="conf"){
	$('#myModal2').modal('show');
	}
	else
	{
		
		$('#myModal').modal('show');
    }
		
	
	
	
    });
</script>

<style>

.btn-responsive {
    white-space: normal ;
    word-wrap: break-word;
}
    body {font-family:Arial, Sans-Serif;}

	.login {
  position: relative;
  padding: 20px 20px 20px;

  background: white;
  border-radius: 7px;
  
</style>

    <title>sweet home</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->

   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 
</head>
<body style="background-color:#B78989;">
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <p>your email has been confirmed and you may now login</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <p>your account has been already  activated you can sign in </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<p id="try"></p>
<div class="container">
 <div class="row">
  	<div class="col-md-7 col-md-offset-2">
<img src="logo.png" alt="logo pic" class="img-responsive" height="" width="600">
</div> 
</div>
    <div class="row">
        <div class="col-md-4 ">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">Login</strong>

                </div>
		
 

 
 <div class="panel-body">
	<form id=form class="form-horizontal"  method="post" action="emailconfirm.php" autocomplete="off"> 
 <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />

<span > <?php echo $error;?></span>


			 <div class="row">
   <div class="form-group col-lg-4">
         <h5 for="inputdefault">username  </h5> 
<input type="text" name="name"  class="form-control" id="inputdefault" > <span > <?php echo $nameerror;?></span>

				</div>
            </div>
			 <div class="row">
            <div class="form-group col-lg-4 ">
             <h5 for="inputdefault"> password</h5> 
<input type="password" name="password"  class="form-control" ><span > <?php echo $passworderror;?></span></td> 
<br> <br> 
            </div>
        </div>



<input type="submit" name="submit" id="one" value="sign in"  class="btn btn-default btn-responsive" > 

<a href="registration.php" id="two"><h4> <U>  Sign up if you don't have account </U> </h4> </a>
</div>
  </form>

</div>
 </div>
   
<!-- our top news -->


</div>

 </div>
</body>
</html>