<?php 
session_start();
include('Database.php');
$hostname = 'localhost:3306';
$username = 'root';
$password = 'fighting?';
$dbName = 'management';
$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_PERSISTENT => false,
	PDO::ATTR_EMULATE_PREPARES => false,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

if(isset($_POST["get_all_columns"])){
	$dataBase = new DB;
	$retrieveColumns = "SHOW columns FROM device_pc";
	$data = $dataBase->getQuery($retrieveColumns);
	$temp_arr = $data->fetchall(PDO::FETCH_ASSOC);
	echo json_encode($temp_arr);

}
if(isset($_POST["get_all_device_pc"])){
	$dataBase = new DB;
	$alldata = "SELECT * FROM device_pc";
	$data = $dataBase->getQuery($alldata);
	$temp_arr = $data->fetchall(PDO::FETCH_ASSOC);
	echo json_encode($temp_arr);
}
if(isset($_POST["getdata_updatepage"])){
	$response = array('data' => array());
	$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
	$stmt = "SELECT id,device_id, brand, device_serial, cpu, ram, charger_serial_number, model, os from device_pc";
	foreach ($pdo->query($stmt) as $row) {
		$response['data'][] = array(
			$row['device_id'],
			$row['brand'],
			$row['device_serial'],
			$row['cpu'],
			$row['ram'],
			$row['charger_serial_number'],
			$row['model'],
			$row['os']
		);
	}
	echo json_encode($response);
}

if(isset($_POST["updaterow"])){
	echo "im triggered" . "id=" .$_POST["device_id"];
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
		echo $e;
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
		echo $e;
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



?>
