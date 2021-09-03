<?php
header('Content-Type: application/json');
include "connection.php";
$data = json_decode(file_get_contents('php://input'), true);
//print_r($data);
if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Get data from the REST client
	$address = $data['address'];
	$email = $data['email'];
	$name = $data['name'];
	$telephone = $data['telephone'];
	
	// Insert data into database
	$sql = "INSERT INTO `emp` (`address`, `email`, `name`,`telephone`) VALUES ('$address', '$email', '$name' ,'$telephone');";
	$result=mysqli_query($conn,$sql) or die("Sql query failed");
	if($result){
		$json = array("status" => 201, "Success" => "Data has been added successfully!");
	}
	else{
		$json = array("status" => 500, "Error" => "Error adding data Please try again!");
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