<?php
header('Content-Type: application/json');
include "connection.php";
$data = json_decode(file_get_contents('php://input'), true);
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
$url = explode("/", $url);
$id = $url[count($url) - 1];
//print_r($data);
if($_SERVER['REQUEST_METHOD'] == "PUT"){
	// Get data from the REST client
	$address = $data['address'];
	$email = $data['email'];
	$name = $data['name'];
	$telephone = $data['telephone'];
	
	$sql1="SELECT id FROM emp where id = '$id' ";
	$result1=mysqli_query($conn,$sql1) or die("Sql query failed");
	if(mysqli_num_rows($result1)>0) {
	
	// Insert data into database
	$sql = "update emp set address='$address', email='$email', name='$name', telephone='$telephone'  where id=$id";
	$result=mysqli_query($conn,$sql) or die("Sql query failed");
	if($result){
		$json = array("status" => 200, "Success" => "Data update successfully!");
		
	}
	else{
		$json = array("status" => 500, "Error" => "Error delete data! Please try again!");
	}
	} else {
		$json = array("Error" => "ID not exists in database");
	}
	
}
else{
	$json = array("status" => 405, "Info" => "Request method not accepted!");
}
@mysqli_close($conn);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);
?>