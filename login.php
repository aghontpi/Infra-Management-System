<?php 
include('Database.php');
$uname = '';
$password = '';

if(isset($_POST["login"])){
	$dataBase = new DB;
	if (isset($_POST["username"]) && isset($_POST["password"]))
	{ 
		echo "im inside the check";
		$uname = $_POST["username"];
		$password = $_POST["password"];	
		$retrieveUser = "SELECT uid,user_name,pwd FROM users WHERE user_name='$uname'";
		$data = $dataBase->getQuery($retrieveUser);
		checkuser($data);
	}
}

function checkuser($temp){
echo "got user data";
echo "$temp";
}

 ?>