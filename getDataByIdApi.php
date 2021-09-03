<?php
header('Content-Type: application/json');
include "connection.php";
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
$url = explode("/", $url);
$id = $url[count($url) - 1];
//print_r($data);
if($_SERVER['REQUEST_METHOD'] == "GET"){
	// Get data from the REST client
	
	$sql1="SELECT id FROM emp where id = '$id' ";
	$result1=mysqli_query($conn,$sql1) or die("Sql query failed");
	if(mysqli_num_rows($result1)>0) {
	// Insert data into database
	$sql = "select * from emp where id=$id";
	$result=mysqli_query($conn,$sql) or die("Sql query failed");
	if($result){
	    $output=mysqli_fetch_all($result,MYSQLI_ASSOC);
	    echo json_encode($output);
	}
	else{
		$json = array("status" => 500, "Error" => "Error delete data! Please try again!");
		echo json_encode($json);
	}
	} else {
		$json = array("Error" => "ID not exists in database");
		echo json_encode($json);
	}
	
}
else{
	$json = array("status" => 405, "Info" => "Request method not accepted!");
}
@mysqli_close($conn);
// Set Content-type to JSON
header('Content-type: application/json');
//echo json_encode($json);
?>