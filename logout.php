<?php
session_start();
if(!isset($_SESSION["login_user"])){
    # redirect to the login page
	
	
    
  
	echo"<html>";	
echo"<head>";

echo"</head>";

echo"<body>	";
echo"<h1>";
echo"sign in first please!";
echo"</h1>";
echo"<a href='log.php'><h4> <U> click to sign in  </U> </h4> </a>";
echo"</body>";
echo"</html>";
}  
else{
if(session_destroy()) // Destroying All Sessions
{
	
header("location:log.php"); // Redirecting To Home Page

}
}
?>