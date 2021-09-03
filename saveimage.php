<?php
define("SERVER","182.50.133.77");
define("USER","prabudh");
define("PASSWORD","Prabudh@123");
define("DB","prabudhbharat");


$mysql=new mysqli(SERVER,USER,PASSWORD,DB);
$response=array();

if($mysql->connect_error)
{
	$response["MESSAGE"]="ERROR IN SERVER";
	$response["status"]=500;
}

else{
	if(is_uploaded_file($_FILES["user_image"]["tmp_name"]) && @$_GET["username"])
	{
		$tmp_file=$_FILES["user_image"]["tmp_name"];
		$img_name=$_FILES["user_image"]["name"];
		$upload_dir="./img/".$img_name;
		//$n="https://www.ecssofttech.com/api/img/";
		//$p=$img_name;
		//$result=$n.$p;
		$sql="insert into testdemo(user_name,user_profile) values('{$_POST['username']}','{$img_name}')";
		
		if(move_uploaded_file($tmp_file,$upload_dir) && $mysql->query($sql)){
			$response["MESSAGE"]="Upload Successfully";
			$response["status"]=200;
		}
		
		else{
			$response["MESSAGE"]="Upload Failed";
			$response["status"]=404;
		}
	}
	
	else{
		$response["MESSAGE"]="Invalid Request";
		$response["status"]=400;
	}
}

echo json_encode($response);
?>