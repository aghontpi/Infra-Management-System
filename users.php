<?php 
session_start();
include('Database.php');

if(empty(@$_SESSION['user_name'])){   
	ob_start();
    header("Location: index.php");
    ob_end_flush();
    die();
}
$db =  new DB;
$count = $db->getNumberPendingAccounts();


?>
<!DOCTYPE html>
<html>
<head>
	<title>Management</title>
	<meta name="description" content="Customised InfraStructure Management Software for Organisation">
    <meta name="author" content="Gopinath">
	<link rel="stylesheet" href="css/main.css" />
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<!---------datatable's used here are 1.9 --->
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
 	<link rel="stylesheet" type="text/css" href="css/dataTables.jqueryui.min.css"/>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/dataTables.jqueryui.min.js"></script>
	<!---------end of datatable's used here are 1.9 --->
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body style="background-color:#083045;">
	<?php include("header.php"); ?>
	<?php

	if(!empty($_GET['id'])){
		$id=$_GET['id'];
		if($id=="add")
		{
			include("addnew.php");
		}
		elseif ($id=="update") {
			include("updateitems.php");
		}
		elseif ($id=="loan") {
			include("loanitems.php");
		}
		elseif ($id=="verify"){
			include("activateusers.php");
		}
		elseif ($id=="device_users"){
			include("sections/add_device_users.php");
		}
		else {
			echo 'Page not Found';
		}
	}else{
		include('dashboard.php');   
	} 

	?>

</body>
</html>