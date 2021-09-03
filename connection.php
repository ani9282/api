<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$servername = "182.50.133.77";
$username = "prabudh";
$password = "Prabudh@123";
$database="prabudhbharat";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn)
{
		die("Connection Failed ". mysqli_connect_error());
}

else{
	//echo"connection create successfully";
}
?>