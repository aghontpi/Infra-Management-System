<?php 
session_start();
include('Database.php');
require('config/conf.php');

if(isset($_POST["get_all_columns"])){
	$dataBase = new DB;
	$retrieveColumns = "SHOW columns FROM device_pc";
	$data = $dataBase->getQuery($retrieveColumns);
	$temp_arr = $data->fetchall(PDO::FETCH_ASSOC);
	echo json_encode($temp_arr);

}
if(isset($_POST["get_all_device_pc"])){
	$dataBase = new DB;
	$alldata = "SELECT id,device_id,brand,device_serial,cpu,ram,charger_serial_number,hard_disk_capacity,model,os,du.user_name as used_by from device_pc dp inner join device_users du on (dp.used_by = du.device_user_id) where dp.used_by !=0";
	$data = $dataBase->getQuery($alldata);
	$temp_arr = $data->fetchall(PDO::FETCH_ASSOC);
	echo json_encode($temp_arr);
}
if(isset($_POST["get_all_device_od"])){
	$dataBase = new DB;
	$alldata = "SELECT * FROM device_other";
	$data = $dataBase->getQuery($alldata);
	$temp_arr = $data->fetchall(PDO::FETCH_ASSOC);
	echo json_encode($temp_arr);
}
if(isset($_POST["updateid"])){
	$id = $_POST["updateid"];
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "SELECT * FROM device_pc WHERE id = {$id}";
	$qres=$pdo->query($stmt);
	$res = $qres->fetch(PDO::FETCH_ASSOC);
	echo json_encode($res);

}
if(isset($_POST["updateid_loan"])){
	$id = $_POST["updateid_loan"];
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "SELECT * FROM device_pc WHERE id = {$id}";
	$qres=$pdo->query($stmt);
	$res = $qres->fetch(PDO::FETCH_ASSOC);
	echo json_encode($res);

}

if(isset($_POST["getRegisteredUsers"])){
	$sql="SELECT user_name FROM users WHERE verified= 0";
	$db = new DB;
	$data = $db->getQuery($sql);
	$arr = $data->fetchall(PDO::FETCH_ASSOC);
	echo json_encode($arr);
}

if(isset($_POST["updateid_od"])){
	$id = $_POST["updateid_od"];
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "SELECT * FROM device_other WHERE id = {$id}";
	$qres=$pdo->query($stmt);
	$res = $qres->fetch(PDO::FETCH_ASSOC);
	echo json_encode($res);

}

if(isset($_POST["userapprovestatus"])){
	$status = $_POST["userapprovestatus"];
	$user = $_POST["user"];
	$response = "";
	if($status==1){
		$db = new DB;
		$db->grantPermission($status,$user);
		if($db){
			echo 1;
		}
		else{
			echo 0;
		}

		
	}
	elseif ($status==2) {
		$db = new DB;
		$db-> deleteUser($user);
		if($db){
			echo 1;
		}
		else{
			echo 0;
		}
	}
}


if(isset($_POST["getdata_updatepage"])){
	$response = array('data' => array());
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "SELECT id,device_id, brand, device_serial, cpu, ram, charger_serial_number, model, os from device_pc";
	foreach ($pdo->query($stmt) as $row) {
		$id = $row['id'];
		$editicon = '<span style="cursor:pointer; padding-right:10px;" onclick="getFieldsForUpdate('.$id.')">&#x2710;</span><span style="cursor:pointer" onclick="deleteFieldsForUpdate('.$id.')">&#x2717;</span>';
		$response['data'][] = array(
			$row['id'],
			$row['device_id'],
			$row['brand'],
			$row['device_serial'],
			$row['cpu'],
			$row['ram'],
			$row['charger_serial_number'],
			$row['model'],
			$row['os'],
			$editicon
		);
	}
	echo json_encode($response);
}
if(isset($_POST["getdata_updatepage_loan"])){
	$response = array('data' => array());
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "SELECT id,device_id,brand,device_serial,charger_serial_number,model, du.user_name as used_by from device_pc dp inner join device_users du on (dp.used_by = du.device_user_id) ";
	if(isset($_POST["onlyStock"])){
		$stmt .= "where dp.used_by = 0";
	}
	else{
		$stmt .= "where dp.used_by != 0";
	}
	foreach ($pdo->query($stmt) as $row) {
		$id = $row['id'];
		$editicon = '<span style="cursor:pointer;" onclick="getFieldsForUpdate_loan('.$id.')">&#x2692;';
		$response['data'][] = array(
			$row['id'],
			$row['device_id'],
			$row['brand'],
			$row['device_serial'],
			$row['charger_serial_number'],
			$row['model'],
			$row['used_by'],
			$editicon
		);
	}
	echo json_encode($response);
}
if(isset($_POST["deleteid_od"])){
	$id = $_POST["deleteid_od"];
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "DELETE FROM device_other WHERE id = {$id}";
	if($pdo->query($stmt)){
		echo 1;
	}
	else
	{
		echo 0;
	}
}

if(isset($_POST["getdata_updatepage_od"])){
	$response = array('data' => array());
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "SELECT * from device_other";
	foreach ($pdo->query($stmt) as $row) {
		$id = $row['id'];
		$editicon = '<span style="cursor:pointer; padding-right:10px;" onclick="getFieldsForUpdate_od('.$id.')">&#x2710;</span><span style="cursor:pointer" onclick="deleteFieldsForUpdate_od('.$id.')">&#x2717;</span>';
		$response['data'][] = array(
			$row['id'],
			$row['device_id'],
			$row['name'],
			$row['serial'],
			$row['brand'],
			$row['other_info'],
			$editicon
		);
	}
	echo json_encode($response);
}


if(isset($_POST["getdata_updatepage_od_loan"])){
	$response = array('data' => array());
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "SELECT * from device_other";
	foreach ($pdo->query($stmt) as $row) {
		$id = $row['id'];
		$editicon = '<span style="cursor:pointer; padding-right:10px;" onclick="getFieldsForUpdate_od_loan('.$id.')">&#x2692;';
		$response['data'][] = array(
			$row['id'],
			$row['device_id'],
			$row['name'],
			$row['serial'],
			$row['brand'],
			$row['used_by'],
			$editicon
		);
	}
	echo json_encode($response);
}




if(isset($_POST["deleteid"])){
	$id = $_POST["deleteid"];
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "DELETE FROM device_pc WHERE id = {$id}";
	if($pdo->query($stmt)){
		echo 1;
	}
	else
	{
		echo 0;
	}
}

if(isset($_POST["updaterow"])){
	$row=[
	'tochange'=>$_POST["id_seq"],
	'd_id'=>$_POST["device_id"],
	'brand'=>$_POST["brand"],
	'd_serial'=>$_POST["device_serial"],
	'cpu'=>$_POST["cpu"],
	'ram'=>$_POST["ram"],
	'ch_serial'=>$_POST["charger_serial"],
	'hd'=>$_POST["harddisk_capacity"],
	'model'=>$_POST["model"],
	'os'=>$_POST["os"]
];
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "UPDATE device_pc SET device_id=:d_id, brand =:brand, device_serial =:d_serial, cpu =:cpu, ram =:ram, charger_serial_number =:ch_serial, hard_disk_capacity =:hd, model =:model, os =:os WHERE id =:tochange;";
	$status = $pdo->prepare($stmt)->execute($row);
	if($status){
		echo 1;
	}
	else
	{
		echo 0;
	}

}

if(isset($_POST["updaterow_loan"])){
	$row=[
	'tochange'=>$_POST["id_seq"],
	'usby'=>$_POST["used_by"]
];
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "UPDATE device_pc SET used_by=(select device_user_id from device_users where user_name =:usby) WHERE id =:tochange;";
	$status = $pdo->prepare($stmt)->execute($row);
	if($status){
		echo 1;
	}
	else
	{
		echo 0;
	}

}

if(isset($_POST["updaterow_"])){
	$row=[
	'tochange'=>$_POST["id_seq"],
	'd_id'=>$_POST["device_id"],
	'brand'=>$_POST["brand"],
	'd_serial'=>$_POST["device_serial"],
	'name'=>$_POST["name"],
	'othinf'=>$_POST["other_info"]
];
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "UPDATE device_other SET device_id=:d_id, brand =:brand, serial =:d_serial, other_info =:othinf, name =:name WHERE id =:tochange;";
	try {
		$status = $pdo->prepare($stmt)->execute($row);
	} catch (Exception $e) {
		$status=0;
	}
	
	if($status){
		echo 1;
	}
	else
	{
		echo 0;
	}

}
if(isset($_POST["updaterow_loan_od"])){
	$row=[
	'tochange'=>$_POST["id_seq"],
	'usby'=>$_POST["used_by"]
];
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "UPDATE device_other SET used_by=:usby WHERE id =:tochange;";
	try {
		$status = $pdo->prepare($stmt)->execute($row);
	} catch (Exception $e) {
		$status=0;
	}
	
	if($status){
		echo 1;
	}
	else
	{
		echo 0;
	}

}




if(isset($_POST["btn_submit_pc"])){
	try{
		$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
		$row = [
			'dev_id'=>$_POST["device_id"],
			'brand_'=>$_POST["brand"],
			'serial_'=>$_POST["device_serial"],
			'cpu_'=>$_POST["cpu"],
			'ram_'=>$_POST["ram"],
			'charger'=>$_POST["charger_serial"],
			'hd_'=>$_POST["harddisk_capacity"],
			'model_'=>$_POST["model"],
			'os_'=>$_POST["os"]
		];
		$sqlstmt="INSERT INTO device_pc SET device_id=:dev_id, brand=:brand_, device_serial=:serial_,cpu=:cpu_, ram=:ram_, charger_serial_number=:charger, hard_disk_capacity=:hd_, model=:model_, os=:os_;";
		$status = $pdo->prepare($sqlstmt)->execute($row);
	}
	catch (PDOException $e){
		$status =false;
		header("Location: users.php?id=add");
		$_SESSION['add_status'] = "There was an error inserting.. troubleshoot! <br> Most probably device id was not unique!";
	}
	if ($status) {
		$lastId = $pdo->lastInsertId();
		header("Location: users.php?id=add");
		$_SESSION['add_status'] = "Success! Insert Success";
	}
	else {
		$_SESSION['add_status'] = "There was an error inserting.. troubleshoot!";
	}
}


if(isset($_POST["btn_submit_device"])){
	try
	{
		$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
		$row=[
			'dev_id'=>$_POST["device_id"],
			'brand_'=>$_POST["brand"],
			'serial_'=>$_POST["device_serial"],
			'name_'=>$_POST["name"],
			'otherInf'=>$_POST["other_info"],
		];


		$sqlstmt="INSERT INTO device_other SET device_id=:dev_id, name=:name_, serial=:serial_, brand=:brand_, other_info=:otherInf";
		$status = $pdo->prepare($sqlstmt)->execute($row);
	}
	catch (PDOException $e){
		$status =false;
		header("Location: users.php?id=add");
		$_SESSION['add_status'] = "There was an error inserting.. troubleshoot! <br> Most probably device id was not unique!";
	}
	if ($status) {
		$lastId = $pdo->lastInsertId();
		header("Location: users.php?id=add");
		$_SESSION['add_status'] = "Success! Insert Success";
	}
	else {
		$_SESSION['add_status'] = "There was an error inserting.. troubleshoot!";
	}
}

/*
Added for further requiremnets.
*/
if(isset($_POST['getDeviceUsers'])){
	$response = array('data' => array());
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "SELECT du.device_user_id AS 'Serial',du.user_name AS 'Users',br.branch_name AS 'Branch' FROM device_users du INNER JOIN branch br ON du.r_branch_id = br.branch_id WHERE device_user_id != 0";
	foreach ($pdo->query($stmt) as $row) {
		$userName =$row['Users'];
		$editicon = '<span style="cursor:pointer; padding-right:10px;" onclick="mapUser('.htmlspecialchars('"',ENT_QUOTES).$userName.htmlspecialchars('"',ENT_QUOTES).')">&#x2710;</span>';
		$response['data'][] = array(
			$row['Serial'],
			$userName,
			$row['Branch'],
			$editicon
		);
	}
	echo json_encode($response);
}

if(isset($_POST['mapUser'])){
	$status = 0;
	try{
		$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
		$data =["user" => $_POST['mapUser'],"branch"=>$_POST['branch']];
		$sql ="UPDATE device_users SET r_branch_id = (SELECT branch_id from branch where branch_name=:branch ) where user_name=:user";
		$status = $pdo->prepare($sql)->execute($data);
	}
	catch (PDOException $e){
		echo "0";
		die();
	}
	echo $status;	
}

if(isset($_POST['nDeviceUser'])){
	$status = 0;
	try{
		$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
		$data =["user" => $_POST['nDeviceUser']];
		$sql ="INSERT INTO device_users SET device_user_id=0, user_name=:user, r_branch_id=0";
		$status = $pdo->prepare($sql)->execute($data);
	}
	catch (PDOException $e){
		echo "0";
		die();
	}
	echo $status;	
}

if(isset($_GET['userL'])){
	$userQuery = $_GET['userL'];
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$sql ="SELECT user_name from device_users where user_name LIKE '%{$userQuery}%'";
	$qres=$pdo->query($sql);
	$res = $qres->fetchall(PDO::FETCH_ASSOC);
	echo json_encode(array_column($res,'user_name'));
}
?>
