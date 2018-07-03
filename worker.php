<?php 
session_start();
include('Database.php');

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


 ?>
