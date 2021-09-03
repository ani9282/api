<?php
header('Content-Type: application/json');
include "connection.php";
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
$url = explode("/", $url);
$id = $url[count($url) - 1];
//print_r($id);
if($_SERVER['REQUEST_METHOD'] == "DELETE"){
	// Get data from the REST client
	//$address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : "";
	//$address = $data['address'];
	//$email = $data['email'];
	//$name = $data['name'];
	//$telephone = $data['telephone'];
	
	$sql1="SELECT id FROM emp where id = '$id' ";
	$result1=mysqli_query($conn,$sql1) or die("Sql query failed");
	if(mysqli_num_rows($result1)>0) {
		
	// Delete data into database
	$sql = "delete from `emp` where id=$id";
	//$post_data_query = mysqli_query($conn, $sql);
	$result=mysqli_query($conn,$sql) or die("Sql query failed");
	if($result){
		$json = array("status" => 200, "Success" => "Data delete successfully!");
		
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