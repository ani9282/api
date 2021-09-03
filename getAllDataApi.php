<?php
header('Content-Type: application/json');
include "connection.php";
//$id=isset($_GET['id']) ? $_GET['id']:die();
//$sql="select * from assign_task where id={$id}";
$sql="select * from emp";
$result=mysqli_query($conn,$sql) or die("Sql query failed");
if(mysqli_num_rows($result)>0)
{
	$output=mysqli_fetch_all($result,MYSQLI_ASSOC);
	echo json_encode($output);
}
else{
	echo json_encode(array('message' => 'No Record Found.','status'=>false));
}
?>